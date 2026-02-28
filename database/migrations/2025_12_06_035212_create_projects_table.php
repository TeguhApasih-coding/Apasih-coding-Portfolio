<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->string('thumbnail')->nullable(); // Thumbnail version for listing
            $table->text('short_description')->nullable(); // For cards/lists
            $table->text('description');
            $table->text('full_description')->nullable(); // Detailed description for modal/page
            $table->text('conclusion')->nullable();
            
            // Project Status & Visibility
            $table->enum('status', ['completed', 'in_progress', 'planned', 'on_hold'])->default('completed');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->integer('view_count')->default(0);
            
            // Project Timeline
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('published_at')->nullable();
            
            // Technologies & Skills
            $table->json('technologies')->nullable(); // ['Laravel', 'Vue.js', 'Tailwind']
            $table->json('categories')->nullable(); // ['Web Development', 'Mobile App', 'UI/UX']
            $table->string('client')->nullable();
            $table->string('client_url')->nullable();
            
            // Links & Resources
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('documentation_url')->nullable();
            
            // SEO & Meta
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            
            // Media Gallery (store as JSON array of image paths)
            $table->json('gallery')->nullable();
            
            // Statistics (can be updated separately)
            $table->integer('likes_count')->default(0);
            $table->integer('shares_count')->default(0);
            $table->integer('comments_count')->default(0);
            
            // Project Complexity & Details
            $table->integer('estimated_hours')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('budget_currency')->default('USD');
            $table->enum('complexity', ['beginner', 'intermediate', 'advanced', 'expert'])->default('intermediate');
            
            // Team & Collaboration
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('team_members')->nullable(); // ['name' => 'John', 'role' => 'Designer']
            $table->json('collaborators')->nullable();
            
            // Project Challenges & Solutions
            $table->text('challenges')->nullable();
            $table->text('solutions')->nullable();
            $table->text('lessons_learned')->nullable();
            
            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('status');
            $table->index('is_published');
            $table->index('is_featured');
            $table->index('user_id');
            $table->index('sort_order');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
