<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\ProjectTag;
use App\Models\ProjectTestimonial;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Clear existing data
        $this->command->info('Starting database seeding...');
        
        // Nonaktifkan foreign key checks untuk MySQL
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Clear existing data dengan urutan yang benar
        $this->command->info('Clearing existing data...');
        
        // Hapus data dari child tables terlebih dahulu
        DB::table('project_testimonials')->delete();
        DB::table('project_project_tag')->delete();
        DB::table('project_skill')->delete();
        
        // Hapus data dari main tables
        DB::table('project_tags')->delete();
        DB::table('projects')->delete();
        DB::table('skills')->delete();
        DB::table('skill_categories')->delete();
        DB::table('contact_messages')->delete();
        DB::table('settings')->delete();
        DB::table('users')->delete();
        
        // Reset auto increment
        $tables = [
            'users',
            'skill_categories', 
            'skills',
            'projects',
            'project_tags',
            'project_testimonials',
            'contact_messages',
            'settings',
            'project_skill',
            'project_project_tag',
        ];
        
        foreach ($tables as $table) {
            DB::statement("ALTER TABLE {$table} AUTO_INCREMENT = 1");
        }
        
        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        // Panggil seeder individual
        $this->call([
            UserSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            ContactMessageSeeder::class,
        ]);
        
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->info('');
        $this->command->info('📊 Data Summary:');
        $this->command->info('   👥 Users: ' . User::count());
        $this->command->info('   📁 Skill Categories: ' . SkillCategory::count());
        $this->command->info('   🛠️ Skills: ' . Skill::count());
        $this->command->info('   💼 Projects: ' . Project::count());
        $this->command->info('   🏷️ Project Tags: ' . ProjectTag::count());
        $this->command->info('   ⭐ Project Testimonials: ' . ProjectTestimonial::count());
        $this->command->info('   📧 Contact Messages: ' . ContactMessage::count());
        $this->command->info('   ⚙️ Settings: ' . Setting::count());
        $this->command->info('');
        $this->command->info('🔑 Login Credentials:');
        $this->command->info('   Email: admin@example.com');
        $this->command->info('   Password: password');
    }
}
