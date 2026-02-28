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
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id();
            
            // Authentication fields
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            // Admin fields
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Profile fields
            $table->string('avatar')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('position')->nullable();
            $table->text('bio')->nullable();
            
            // Social & contact
            $table->json('social_links')->nullable();
            $table->string('website')->nullable();
            
            // Tracking
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->string('last_login_user_agent')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['is_admin', 'is_active']);
            $table->index('email');
            $table->index('created_at');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
