<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating skill categories...');
        
        // 1. Create Skill Categories
        $categories = [
            ['name' => 'Frontend Development', 'display_order' => 1],
            ['name' => 'Backend Development', 'display_order' => 2],
            ['name' => 'Database', 'display_order' => 3],
            ['name' => 'DevOps & Tools', 'display_order' => 4],
            ['name' => 'Soft Skills', 'display_order' => 5],
        ];

        foreach ($categories as $category) {
            SkillCategory::create($category);
        }

        // 2. Create Skills
        $this->command->info('Creating skills...');
        $skills = [
            // Frontend
            [
                'name' => 'HTML5', 'category_id' => 1, 'level' => 95, 
                'color' => '#E34F26', 'is_featured' => true, 'display_order' => 1
            ],
            [
                'name' => 'CSS3', 'category_id' => 1, 'level' => 90,
                'color' => '#1572B6', 'is_featured' => true, 'display_order' => 2
            ],
            [
                'name' => 'JavaScript', 'category_id' => 1, 'level' => 85,
                'color' => '#F7DF1E', 'is_featured' => true, 'display_order' => 3
            ],
            [
                'name' => 'Vue.js', 'category_id' => 1, 'level' => 80,
                'color' => '#4FC08D', 'is_featured' => true, 'display_order' => 4
            ],
            [
                'name' => 'Tailwind CSS', 'category_id' => 1, 'level' => 88,
                'color' => '#06B6D4', 'is_featured' => true, 'display_order' => 5
            ],
            
            // Backend
            [
                'name' => 'PHP', 'category_id' => 2, 'level' => 90,
                'color' => '#777BB4', 'is_featured' => true, 'display_order' => 1
            ],
            [
                'name' => 'Laravel', 'category_id' => 2, 'level' => 85,
                'color' => '#FF2D20', 'is_featured' => true, 'display_order' => 2
            ],
            [
                'name' => 'Node.js', 'category_id' => 2, 'level' => 70,
                'color' => '#339933', 'is_featured' => false, 'display_order' => 3
            ],
            [
                'name' => 'REST API', 'category_id' => 2, 'level' => 88,
                'color' => '#FF6B6B', 'is_featured' => true, 'display_order' => 4
            ],
            
            // Database
            [
                'name' => 'MySQL', 'category_id' => 3, 'level' => 85,
                'color' => '#4479A1', 'is_featured' => true, 'display_order' => 1
            ],
            [
                'name' => 'PostgreSQL', 'category_id' => 3, 'level' => 75,
                'color' => '#336791', 'is_featured' => false, 'display_order' => 2
            ],
            [
                'name' => 'MongoDB', 'category_id' => 3, 'level' => 65,
                'color' => '#47A248', 'is_featured' => false, 'display_order' => 3
            ],
            
            // DevOps & Tools
            [
                'name' => 'Git', 'category_id' => 4, 'level' => 90,
                'color' => '#F05032', 'is_featured' => true, 'display_order' => 1
            ],
            [
                'name' => 'Docker', 'category_id' => 4, 'level' => 70,
                'color' => '#2496ED', 'is_featured' => false, 'display_order' => 2
            ],
            [
                'name' => 'AWS', 'category_id' => 4, 'level' => 60,
                'color' => '#FF9900', 'is_featured' => false, 'display_order' => 3
            ],
            
            // Soft Skills
            [
                'name' => 'Problem Solving', 'category_id' => 5, 'level' => 88,
                'color' => '#8B5CF6', 'is_featured' => true, 'display_order' => 1
            ],
            [
                'name' => 'Team Collaboration', 'category_id' => 5, 'level' => 85,
                'color' => '#EC4899', 'is_featured' => false, 'display_order' => 2
            ],
            [
                'name' => 'Project Management', 'category_id' => 5, 'level' => 80,
                'color' => '#10B981', 'is_featured' => false, 'display_order' => 3
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
        
        $this->command->info('✅ Skill seeding completed!');
    }
}
