<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTag;
use App\Models\ProjectTestimonial;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating project tags...');
        
        // 1. Create Project Tags
        $tags = [
            ['name' => 'Web Development', 'color' => '#3B82F6', 'description' => 'Web-based applications and websites'],
            ['name' => 'Mobile App', 'color' => '#10B981', 'description' => 'Mobile applications for iOS and Android'],
            ['name' => 'E-Commerce', 'color' => '#F59E0B', 'description' => 'Online shopping platforms'],
            ['name' => 'CMS', 'color' => '#EF4444', 'description' => 'Content Management Systems'],
            ['name' => 'API', 'color' => '#8B5CF6', 'description' => 'Application Programming Interfaces'],
            ['name' => 'Dashboard', 'color' => '#EC4899', 'description' => 'Admin dashboards and analytics'],
            ['name' => 'Responsive Design', 'color' => '#06B6D4', 'description' => 'Mobile-friendly responsive designs'],
            ['name' => 'SaaS', 'color' => '#F97316', 'description' => 'Software as a Service platforms'],
            ['name' => 'UI/UX Design', 'color' => '#8B5CF6', 'description' => 'User Interface and Experience design'],
        ];

        foreach ($tags as $tag) {
            ProjectTag::create([
                'name' => $tag['name'],
                'slug' => Str::slug($tag['name']),
                'color' => $tag['color'],
                'description' => $tag['description'],
            ]);
        }

        // 2. Create Projects
        $this->command->info('Creating projects...');
        
        // Get admin user
        $adminUser = User::where('email', 'admin@example.com')->first();
        
        if (!$adminUser) {
            $adminUser = User::first();
        }
        
        // Create projects
        $projectsData = [
            [
                'title' => 'E-Commerce Platform',
                'short_description' => 'A modern e-commerce platform with real-time inventory management',
                'description' => 'Full-featured e-commerce platform with admin dashboard, payment integration, and real-time analytics.',
                'full_description' => "This comprehensive e-commerce platform was built to handle thousands of products and customers. It includes features like:\n\n- Multi-vendor marketplace support\n- Real-time inventory management\n- Integrated payment gateways (Stripe, PayPal)\n- Advanced search and filtering\n- Customer review system\n- Order tracking and notifications\n- Admin dashboard with analytics\n\nBuilt with Laravel for the backend and Vue.js for the frontend, ensuring a smooth user experience.",
                'status' => 'completed',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Redis', 'Tailwind CSS', 'Stripe API'],
                'categories' => ['Web Development', 'E-Commerce'],
                'complexity' => 'advanced',
                'estimated_hours' => 450,
                'budget' => 15000,
            ],
            [
                'title' => 'Task Management Dashboard',
                'short_description' => 'Collaborative project management tool for teams',
                'description' => 'Real-time task management system with team collaboration features.',
                'full_description' => "This project management dashboard helps teams organize tasks, track progress, and collaborate effectively. Key features include:\n\n- Real-time task updates\n- Team collaboration with @mentions\n- File attachments and comments\n- Time tracking and reporting\n- Kanban board and calendar views\n- Email notifications\n\nBuilt with modern technologies for optimal performance.",
                'status' => 'in_progress',
                'technologies' => ['Laravel', 'React', 'MySQL', 'Socket.io', 'Bootstrap'],
                'categories' => ['Web Development', 'Dashboard'],
                'complexity' => 'intermediate',
                'estimated_hours' => 300,
                'budget' => 8000,
            ],
            [
                'title' => 'Real Estate Listing Website',
                'short_description' => 'Property listing platform with virtual tours',
                'description' => 'Comprehensive real estate platform with property search and virtual tour features.',
                'full_description' => "This platform connects property buyers with sellers and agents. It includes:\n\n- Advanced property search with filters\n- Virtual tour integration\n- Mortgage calculator\n- Agent profile and listing management\n- Property comparison tool\n- Saved searches and favorites\n\nDesigned to be user-friendly and accessible on all devices.",
                'status' => 'completed',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'AWS S3', 'Google Maps API'],
                'categories' => ['Web Development', 'Responsive Design'],
                'complexity' => 'advanced',
                'estimated_hours' => 350,
                'budget' => 12000,
            ],
            [
                'title' => 'Healthcare Appointment System',
                'short_description' => 'Online appointment booking for medical clinics',
                'description' => 'System for managing patient appointments and medical records.',
                'full_description' => "This healthcare system streamlines appointment scheduling and patient management. Features include:\n\n- Online appointment booking\n- Patient portal with medical history\n- Doctor schedule management\n- Prescription management\n- Telemedicine integration\n- Billing and insurance processing\n\nBuilt with security and HIPAA compliance in mind.",
                'status' => 'completed',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'JWT Auth', 'Twilio'],
                'categories' => ['Web Development', 'SaaS'],
                'complexity' => 'expert',
                'estimated_hours' => 500,
                'budget' => 20000,
            ],
            [
                'title' => 'Social Media Analytics Tool',
                'short_description' => 'Analytics dashboard for social media performance',
                'description' => 'Track and analyze social media metrics across multiple platforms.',
                'full_description' => "This analytics tool provides insights into social media performance. It includes:\n\n- Multi-platform analytics (Facebook, Twitter, Instagram)\n- Competitor analysis\n- Content performance tracking\n- Audience demographics\n- Automated reporting\n- ROI calculation\n\nHelps businesses optimize their social media strategy.",
                'status' => 'in_progress',
                'technologies' => ['Node.js', 'React', 'MongoDB', 'Chart.js', 'Social APIs'],
                'categories' => ['Web Development', 'Dashboard', 'API'],
                'complexity' => 'advanced',
                'estimated_hours' => 400,
                'budget' => 15000,
            ],
        ];
        
        $projects = [];
        
        foreach ($projectsData as $index => $projectData) {
            $project = Project::create(array_merge($projectData, [
                'slug' => Str::slug($projectData['title']),
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'thumbnail' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'is_published' => true,
                'is_featured' => $index < 3, // First 3 projects are featured
                'sort_order' => $index + 1,
                'view_count' => rand(100, 1000),
                'start_date' => now()->subMonths(rand(6, 18)),
                'end_date' => $projectData['status'] === 'completed' ? now()->subMonths(rand(1, 5)) : null,
                'published_at' => now()->subMonths(rand(1, 12)),
                'client' => ['Tech Corp', 'Startup Inc', 'Global Solutions', 'Digital Agency', 'Health Systems'][$index % 5],
                'client_url' => 'https://example.com',
                'live_url' => 'https://' . Str::slug($projectData['title']) . '.com',
                'github_url' => 'https://github.com/username/' . Str::slug($projectData['title']),
                'demo_url' => 'https://demo.' . Str::slug($projectData['title']) . '.com',
                'meta_title' => $projectData['title'] . ' - Project Portfolio',
                'meta_description' => $projectData['description'],
                'meta_keywords' => $projectData['technologies'],
                'gallery' => [
                    'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                ],
                'likes_count' => rand(50, 200),
                'shares_count' => rand(10, 50),
                'comments_count' => rand(5, 30),
                'budget_currency' => 'USD',
                'user_id' => $adminUser->id,
                'team_members' => [
                    ['name' => 'John Developer', 'role' => 'Backend Developer'],
                    ['name' => 'Sarah Designer', 'role' => 'UI/UX Designer'],
                    ['name' => 'Mike Tester', 'role' => 'QA Engineer'],
                ],
                'collaborators' => [
                    ['name' => 'Design Studio', 'role' => 'Design Partner'],
                    ['name' => 'Cloud Host', 'role' => 'Hosting Provider'],
                ],
                'challenges' => 'Managing real-time data synchronization and ensuring platform scalability.',
                'solutions' => 'Implemented Redis for caching and used Laravel Horizon for queue management.',
                'lessons_learned' => 'Importance of proper database indexing and implementing proper error handling from the start.',
                'conclusion' => 'The project was successfully delivered on time and exceeded client expectations.',
            ]));
            
            $projects[] = $project;
        }
        
        // Attach tags to projects
        $this->command->info('Attaching tags to projects...');
        
        foreach ($projects as $project) {
            // Attach random tags (2-4 tags per project)
            $tagIds = ProjectTag::inRandomOrder()->limit(rand(2, 4))->pluck('id')->toArray();
            $project->tags()->attach($tagIds);
            
            // Attach random skills (3-6 skills per project)
            $skillIds = Skill::inRandomOrder()->limit(rand(3, 6))->pluck('id')->toArray();
            $project->skills()->attach($skillIds);
            
            // Create testimonials for each project
            $testimonialCount = rand(1, 3);
            for ($i = 0; $i < $testimonialCount; $i++) {
                ProjectTestimonial::create([
                    'project_id' => $project->id,
                    'client_name' => fake()->name(),
                    'client_position' => fake()->jobTitle(),
                    'client_company' => $project->client,
                    'client_avatar' => 'https://i.pravatar.cc/150?img=' . rand(1, 70),
                    'testimonial' => fake()->paragraphs(2, true),
                    'rating' => rand(4, 5),
                    'is_featured' => $i === 0,
                    'is_approved' => true,
                ]);
            }
        }
        
        $this->command->info('✅ Project seeding completed! Created ' . count($projects) . ' projects.');
    }
}
