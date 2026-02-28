<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating admin user...');
        
        // 1. Create Admin User - Convert social_links to JSON string
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'position' => 'Full Stack Developer',
            'bio' => 'Experienced full stack developer specializing in Laravel and Vue.js with over 5 years of professional experience.',
            'social_links' => json_encode([  // Convert array to JSON string
                'github' => 'https://github.com/admin',
                'linkedin' => 'https://linkedin.com/in/admin',
                'twitter' => 'https://twitter.com/admin',
            ]),
            'website' => 'https://portfolio.example.com',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // 2. Create regular users
        $this->command->info('Creating regular users...');
        
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'position' => 'Frontend Developer',
            'bio' => 'Frontend specialist with expertise in Vue.js and React.',
            'social_links' => json_encode([
                'github' => 'https://github.com/johndoe',
                'linkedin' => 'https://linkedin.com/in/johndoe',
            ]),
            'website' => 'https://johndoe.dev',
            'is_admin' => false,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'position' => 'UI/UX Designer',
            'bio' => 'Creative designer focused on user experience and interface design.',
            'social_links' => json_encode([
                'dribbble' => 'https://dribbble.com/janesmith',
                'behance' => 'https://behance.net/janesmith',
                'linkedin' => 'https://linkedin.com/in/janesmith',
            ]),
            'website' => 'https://janesmith.design',
            'is_admin' => false,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create additional users using factory (dengan penyesuaian)
        User::factory()->create([
            'name' => 'Robert Johnson',
            'email' => 'robert@example.com',
            'social_links' => json_encode([
                'github' => 'https://github.com/robert',
                'twitter' => 'https://twitter.com/robert',
            ]),
        ]);

        User::factory()->create([
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'social_links' => json_encode([
                'linkedin' => 'https://linkedin.com/in/emily',
                'instagram' => 'https://instagram.com/emily',
            ]),
        ]);

        User::factory()->create([
            'name' => 'Michael Wilson',
            'email' => 'michael@example.com',
            'social_links' => json_encode([
                'github' => 'https://github.com/michael',
                'website' => 'https://michaelwilson.dev',
            ]),
        ]);
        
        $this->command->info('✅ User seeding completed! Created 6 users.');
    }
}
