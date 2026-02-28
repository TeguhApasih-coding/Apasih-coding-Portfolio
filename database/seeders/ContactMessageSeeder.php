<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating contact messages...');
        
        // Create some sample messages
        $messages = [
            [
                'name' => 'John Client',
                'email' => 'john.client@example.com',
                'subject' => 'Project Inquiry',
                'message' => 'I saw your portfolio and I\'m interested in discussing a potential project. Can we schedule a call next week?',
                'is_spam' => false,
                'is_read' => true,
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ],
            [
                'name' => 'Sarah Recruiter',
                'email' => 'sarah@techcompany.com',
                'subject' => 'Job Opportunity',
                'message' => 'We\'re looking for a Laravel developer for our team. Your portfolio looks impressive. Are you open to new opportunities?',
                'is_spam' => false,
                'is_read' => true,
                'ip_address' => '203.0.113.45',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15',
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alexj@gmail.com',
                'subject' => 'Question about Vue.js implementation',
                'message' => 'I really like how you implemented the real-time features in your e-commerce project. Can you share some insights about your Vue.js setup?',
                'is_spam' => false,
                'is_read' => false,
                'ip_address' => '198.51.100.23',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael@startup.io',
                'subject' => 'Collaboration Proposal',
                'message' => 'We\'re building a SaaS platform and would love to collaborate with you. Your expertise in Laravel would be valuable for our project.',
                'is_spam' => false,
                'is_read' => false,
                'ip_address' => '172.16.254.1',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 11; SM-G991B) AppleWebKit/537.36',
            ],
            [
                'name' => 'Spam Bot',
                'email' => 'spam@spam.com',
                'subject' => 'Buy cheap products',
                'message' => 'Buy our cheap products now! Limited time offer! Click here: http://spamlink.com',
                'is_spam' => true,
                'is_read' => true,
                'ip_address' => '10.0.0.1',
                'user_agent' => 'Mozilla/5.0 (compatible; SpamBot/1.0)',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@designstudio.com',
                'subject' => 'Design Collaboration',
                'message' => 'I\'m a UI/UX designer and I love your projects. Would you be interested in collaborating on a design system project?',
                'is_spam' => false,
                'is_read' => false,
                'ip_address' => '203.0.113.67',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0',
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert@university.edu',
                'subject' => 'Guest Lecture Request',
                'message' => 'Our computer science department would like to invite you for a guest lecture about modern web development. Are you available next month?',
                'is_spam' => false,
                'is_read' => true,
                'ip_address' => '198.51.100.89',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            ],
            [
                'name' => 'Phishing Attempt',
                'email' => 'security@fake-bank.com',
                'subject' => 'URGENT: Your account has been compromised',
                'message' => 'Click here to verify your account: http://fake-bank-phishing.com',
                'is_spam' => true,
                'is_read' => true,
                'ip_address' => '192.0.2.1',
                'user_agent' => 'Mozilla/5.0 (compatible; PhishBot/2.0)',
            ],
        ];
        
        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
        
        // Create additional random messages
        ContactMessage::factory(7)->create();
        
        $this->command->info('✅ Contact message seeding completed! Created ' . ContactMessage::count() . ' messages.');
    }
}
