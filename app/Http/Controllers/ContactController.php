<?php

namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use App\Models\ContactMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\IFTTTHandler;

use function Symfony\Component\Clock\now;

class ContactController extends Controller
{
    public function sendMessage(Request $request) {
        // Validation Rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:500',
            'message' => 'required|string|min:10|max:2000'
        ]);

        try{
            $ipAddress = $request->ip();
            // ANTI-SPAM: RATE LIMITING PER IP
            $rateLimitKey = 'contact_rate_limit:' . $ipAddress;

            $attempts  = Cache::get($rateLimitKey, 0);
            if ($attempts  >= 5) { // Max 5 pesan per jam
                Log::warning('Rate limit exceeded for IP: ', ['ip' => $ipAddress]);
                return response()->json([
                    'success' => false,
                    'message' => '❌ Too many attempts. Please try again in an hour.'
                ], 429);
            }

            // ANTI-SPAM: HONEYPOT FIELD (jika ada)
            if (!empty($request->website)) {
                Log::info('Honeypot triggered for IP: ', ['ip' => $ipAddress]);
                return response()->json(['success' => true]); // Fake success for bots
            }

            // ANTI-SPAM: SUSPICIOUS CONTENT DETECTION
            $spamResult = $this->detectSpamContent($validated);
            if ($spamResult['is_spam']) {
                $this->saveAsSpam($validated, $ipAddress, $request->userAgent(), $spamResult['reason']);
                return response()->json([
                    'success' => false,
                    'message' => '❌ ' . $spamResult['message']
                ], 422);
            }

            // ANTI-SPAM: Duplicate message check (last 24 hours)
            if ($this->isDuplicateMessage($validated['message'], $ipAddress)) {
                Log::warning('Duplicate message detected', ['ip' => $ipAddress]);
                return response()->json([
                    'success' => false,
                    'message' => '❌ Similar message already sent recently.'
                ], 422);
            }

            // Save to database
            $contact = ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent(),
                'is_spam' => false,
                'is_read' => false
            ]);

            // UPDATE RATE LIMIT COUNTER
            Cache::put($rateLimitKey, $attempts  + 1, 3600); // 1 jam

            // Send email notification
            // Mail::to('anuapayah1@gmail.com')->send(new ContactNotification($contact));
            Mail::to(config('mail.from.address'))->send(new ContactNotification($contact));

            // Log success
            Log::info('Contact message sent successfully', [
                'id' => $contact->id,
                'email' => $contact->email,
                'ip' => $ipAddress
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Message sent successfully! I\'ll reply soon.'
            ]);
        } catch(\Illuminate\Validation\ValidationException $e){
            // Validation error
            return response()->json([
                'success' => false,
                'message' => '❌ Please check your input.',
                'errors' => $e->errors()
            ], 422);
        }catch(\Exception $e){
            // General error
            Log::error('Contact form error: ' . $e->getMessage(), [
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => '❌ Server error. Please try again later.'
            ], 500);
        }
    }

    /**
     * Detect spam content dalam pesan
     */
    private function detectSpamContent(array $data):array {
        $message = strtolower(trim($data['message']));
        $messageLength = strlen($message);

        // 1. CHECK MINIMUM LENGTH
        if ($messageLength < 20) {
            return [
                'is_spam' => true,
                'reason' => 'too_short',
                'message' => 'Message too short. Minimum 20 characters required.'
            ];
        }

        // 2. Check for spam keywords
        $spamKeywords = [
            'http://', 'https://', '[url]', '[link]',
            'buy now', 'discount', 'cheap', 'viagra', 'cialis',
            'lottery', 'winner', 'prize', 'cash', 'money',
            'investment', 'profit', 'earn money',
            'follower', 'like', 'subscription',
            'urgent', 'asap', 'immediately'
        ];

        foreach ($spamKeywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return [
                    'is_spam' => true,
                    'reason' => 'spam_keyword',
                    'message' => 'Message contains suspicious content.'
                ];
            }
        }

        // 3. TOO MANY LINK
        $linkCount = substr_count($message, 'http') + substr_count($message, 'www.');
        if ($linkCount > 3) {
            return [
                'is_spam' => true,
                'reason' => 'too_many_links',
                'message' => 'Message contains too many links.'
            ];
        }

        // 4. Check for meaningful content (at least 3 words with vowels)
        $words = preg_split('/\s+/', $message);
        $meaningfulWords = array_filter($words, function($word) {
            return strlen($word) > 2 && preg_match('/[aeiou]/i', $word);
        });
        if (count($meaningfulWords) < 3) {
            return [
                'is_spam' => true,
                'reason' => 'no_meaning',
                'message' => 'Message doesn\'t contain meaningful words.'
            ];
        }

        return [
            'is_spam' => false,
            'reason' => 'clean',
            'message' => ''
        ];
    }

    /**
     * Save message as spam
     */
    private function saveAsSpam(array $data, string $ipAddress, ?string $userAgent, string $reason) : void {
        ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'is_spam' => true,
            'is_read' => true
        ]);

        Log::info('Message saved as spam', [
            'reason' => $reason,
            'ip' => $ipAddress,
            'email' => $data['email']
        ]);
    }

    /**
     * Check duplicate message dari IP yang sama
     */
    private function isDuplicateMessage(string $message, string $ipAddress):bool {
        // Check for exact same message from same IP in last 24 hours
        $recentMessages = ContactMessage::where('ip_address', $ipAddress)
            ->where('created_at', '>', Carbon::now()->subDay())
            ->get();
            
        foreach ($recentMessages as $recent) {
            similar_text(
                strtolower(trim($message)),
                strtolower(trim($recent->message)),
                $similarity
            );
            
            if ($similarity > 80) { // 80% similar
                return true;
            }
        }
        
        return false;
    }

    /**
     * ADMIN: Show all contact messages
     */
    public function index() {
        $messages = ContactMessage::latest()->paginate(20);
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::where('is_read', false)->count(),
            'spam' => ContactMessage::where('is_spam', true)->count(),
            'today' => ContactMessage::whereDate('created_at', today())->count()
        ];
        return view('admin.emails.contact-messages', compact('messages', 'stats'));
    }

    /**
     * ADMIN: Show single message
     */
    public function show(ContactMessage $message) {
        // Mark as read when viewing
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        $similarMessages = ContactMessage::where('ip_address', $message->ip_address)
        ->where('id', '!=', $message->id)->latest()->take(5)->get();
        return view('admin.emails.show', compact('message', 'similarMessages'));
    }

     /**
     * ADMIN: Mark message as read/unread
     */
     public function markAsRead(ContactMessage $message) {
        $message->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read'
        ]);
     }

     /**
     * ADMIN: Mark as spam/not spam
     */
    public function markAsSpam(ContactMessage $message) {
        $message->update(['is_spam' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as spam'
        ]);
    }

    /**
     * ADMIN: Delete message
     */
    public function destroy(ContactMessage $message) {
        $message->delete();

        return redirect()->route('admin.contact.message')->with('success', 'Message deleted succesfully');
    }

    /**
     * ADMIN: Bulk actions
     */
    public function bulkAction(Request $request) {
        $action = $request->input('action');
        $ids = $request->input('ids');

        if ($action === 'delete') {
            ContactMessage::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Messages deleted']);
        }

        if ($action === 'mark_read') {
            ContactMessage::whereIn('id', $ids)->update(['is_read' => true]);
            return response()->json(['success' => true, 'message' => 'Messages marked as read']);
        }

        if ($action === 'mark_spam') {
            ContactMessage::whereIn('id', $ids)->update(['is_spam' => true]);
            return response()->json(['success' => true, 'message' => 'Messages marked as spam']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid action'], 422);
    }
}
