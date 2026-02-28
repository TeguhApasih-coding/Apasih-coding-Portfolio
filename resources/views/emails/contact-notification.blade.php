{{-- <x-app-layout>
    <div class="header">
        <h1>📧 New Portfolio Message</h1>
    </div>
    <div class="content">
        <div class="field">
            <strong>Name:</strong> {{ $contact->name }}
        </div>
        <div class="field">
            <strong>Email:</strong> {{ $contact->email }}
        </div>
        <div class="field">
            <strong>Subject:</strong> {{ $contact->subject ?? 'No Subject' }}
        </div>
        <div class="field">
            <strong>Message:</strong>
        </div>
        <div class="message">
            {{ $contact->message }}
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
        Sent from your portfolio website on {{ now()->format('F j, Y \a\t g:i A') }}
    </div>
</x-app-layout> --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #246F75; color: white; padding: 20px; border-radius: 5px 5px 0 0; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .field { margin-bottom: 15px; padding: 10px; background: white; border-radius: 3px; }
        .field-label { font-weight: bold; color: #246F75; display: block; margin-bottom: 5px; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #246F75; margin-top: 10px; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
        .action-btn { display: inline-block; background: #246F75; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 New Portfolio Message</h1>
            <p>You have received a new contact form submission</p>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="field-label">From:</span>
                {{ $contact->name }}
            </div>
            
            <div class="field">
                <span class="field-label">Email:</span>
                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
            </div>
            
            <div class="field">
                <span class="field-label">Subject:</span>
                {{ $contact->subject ?? 'No Subject' }}
            </div>
            
            <div class="field">
                <span class="field-label">Date:</span>
                {{ $contact->created_at->format('F j, Y \a\t g:i A') }}
            </div>
            
            <div class="field">
                <span class="field-label">Message:</span>
                <div class="message-box">
                    {{ $contact->message }}
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?? 'Your Portfolio Message' }}" 
                   class="action-btn">
                   📩 Reply to {{ $contact->name }}
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>Message ID: #{{ $contact->id }}</p>
            <p>IP Address: {{ $contact->ip_address }}</p>
            <p>Sent from your portfolio contact form</p>
        </div>
    </div>
</body>
</html>

<!-- resources/views/emails/contact-notification.blade.php -->
{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #246F75; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; }
        .field { margin-bottom: 15px; }
        .field strong { display: inline-block; width: 80px; }
        .message { background: white; padding: 15px; border-radius: 5px; border-left: 4px solid #246F75; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 New Portfolio Message</h1>
        </div>
        <div class="content">
            <div class="field">
                <strong>Name:</strong> {{ $contact->name }}
            </div>
            <div class="field">
                <strong>Email:</strong> {{ $contact->email }}
            </div>
            <div class="field">
                <strong>Subject:</strong> {{ $contact->subject ?? 'No Subject' }}
            </div>
            <div class="field">
                <strong>Message:</strong>
            </div>
            <div class="message">
                {{ $contact->message }}
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
            Sent from your portfolio website on {{ now()->format('F j, Y \a\t g:i A') }}
        </div>
    </div>
</body>
</html> --}}