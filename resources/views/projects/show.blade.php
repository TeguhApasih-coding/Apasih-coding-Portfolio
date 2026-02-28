<x-guest-layout>

<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    
    {{-- Hero Section dengan Background Image --}}
    <section class="relative h-[60vh] min-h-[500px] overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/30 z-10"></div>
            <img src="{{ $project->image_url }}" 
                 alt="{{ $project->title }}"
                 class="w-full h-full object-cover"
                 onerror="this.onerror=null; this.src='{{ asset('images/default-project-bg.jpg') }}'">
        </div>

        {{-- Content --}}
        <div class="relative z-20 container mx-auto px-4 h-full flex items-end pb-16">
            <div class="max-w-4xl">
                {{-- Status Badges --}}
                <div class="flex flex-wrap gap-3 mb-4">
                    @if($project->is_featured)
                        <span class="px-4 py-1.5 bg-yellow-400 text-gray-900 rounded-full text-sm font-semibold">
                            ⭐ Featured
                        </span>
                    @endif
                    
                    @if(auth()->check() && $isAdmin)
                        <span class="px-4 py-1.5 bg-purple-500 text-white rounded-full text-sm font-semibold">
                            👑 Admin View
                        </span>
                    @endif
                    
                    {!! $project->status_badge !!}
                    {!! $project->complexity_badge !!}
                </div>

                {{-- Title --}}
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 leading-tight">
                    {{ $project->title }}
                </h1>

                {{-- Short Description --}}
                <p class="text-xl text-gray-200 mb-6 max-w-3xl">
                    {{ $project->short_description }}
                </p>

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-6 text-gray-300">
                    @if($project->start_date)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $project->duration }}</span>
                        </div>
                    @endif

                    @if($project->client)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Client: {{ $project->client }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                
                {{-- Left Column - Main Content --}}
                <div class="lg:w-2/3">
                    
                    {{-- Navigation Tabs --}}
                    <div class="border-b border-gray-200 mb-8">
                        <nav class="flex space-x-8">
                            <button onclick="switchTab('overview')" 
                                    class="tab-button active pb-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm">
                                Overview
                            </button>
                            <button onclick="switchTab('details')" 
                                    class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                                Details
                            </button>
                            @if($project->challenges || $project->solutions || $project->lessons_learned)
                            <button onclick="switchTab('challenges')" 
                                    class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                                Challenges & Solutions
                            </button>
                            @endif
                        </nav>
                    </div>

                    {{-- Tab Content --}}
                    <div id="overview" class="tab-content">
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>

                    <div id="details" class="tab-content hidden">
                        <div class="prose prose-lg max-w-none">
                            <h2 class="text-2xl font-bold mb-4">Detailed Information</h2>
                            {!! nl2br(e($project->full_description)) !!}
                            
                            @if($project->conclusion)
                                <h3 class="text-xl font-bold mt-8 mb-4">Conclusion</h3>
                                {!! nl2br(e($project->conclusion)) !!}
                            @endif
                        </div>
                    </div>

                    <div id="challenges" class="tab-content hidden">
                        <div class="space-y-8">
                            @if($project->challenges)
                                <div class="bg-red-50 p-6 rounded-xl">
                                    <h3 class="text-xl font-bold text-red-800 mb-4 flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Challenges
                                    </h3>
                                    {!! nl2br(e($project->challenges)) !!}
                                </div>
                            @endif

                            @if($project->solutions)
                                <div class="bg-green-50 p-6 rounded-xl">
                                    <h3 class="text-xl font-bold text-green-800 mb-4 flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Solutions
                                    </h3>
                                    {!! nl2br(e($project->solutions)) !!}
                                </div>
                            @endif

                            @if($project->lessons_learned)
                                <div class="bg-blue-50 p-6 rounded-xl">
                                    <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        Lessons Learned
                                    </h3>
                                    {!! nl2br(e($project->lessons_learned)) !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Gallery Section --}}
                    @if(!empty($project->gallery_urls))
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold mb-6">Project Gallery</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($project->gallery_urls as $index => $image)
                                    <div class="relative group cursor-pointer" onclick="openGallery({{ $index }})">
                                        <img src="{{ $image }}" 
                                             alt="Gallery image {{ $index + 1 }}"
                                             class="w-full h-48 object-cover rounded-lg transition duration-300 group-hover:opacity-75">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Testimonials --}}
                    @if($project->testimonials && $project->testimonials->count() > 0)
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold mb-6">Testimonials</h2>
                            <div class="space-y-4">
                                @foreach($project->testimonials as $testimonial)
                                    <div class="bg-gray-50 p-6 rounded-xl">
                                        <p class="text-gray-700 italic">"{{ $testimonial->content }}"</p>
                                        <div class="mt-4 flex items-center gap-3">
                                            @if($testimonial->avatar)
                                                <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->author }}" class="w-10 h-10 rounded-full">
                                            @endif
                                            <div>
                                                <p class="font-semibold">{{ $testimonial->author }}</p>
                                                @if($testimonial->position)
                                                    <p class="text-sm text-gray-500">{{ $testimonial->position }}, {{ $testimonial->company }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Column - Sidebar --}}
                <div class="lg:w-1/3 space-y-6">
                    
                    {{-- Stats Card --}}
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Project Statistics
                        </h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">{{ number_format($project->view_count) }}</div>
                                <div class="text-xs text-gray-500">Views</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-green-600">{{ number_format($project->likes_count) }}</div>
                                <div class="text-xs text-gray-500">Likes</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600">{{ number_format($project->shares_count) }}</div>
                                <div class="text-xs text-gray-500">Shares</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-orange-600">{{ number_format($project->comments_count) }}</div>
                                <div class="text-xs text-gray-500">Comments</div>
                            </div>
                        </div>
                    </div>

                    {{-- Technologies Card --}}
                    @if(!empty($project->technologies))
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                            <h3 class="text-lg font-semibold mb-4">Technologies Used</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->technologies as $tech)
                                    <span class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-blue-100 hover:text-blue-700 transition duration-300">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Project Details Card --}}
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Project Details</h3>
                        
                        <div class="space-y-4">
                            @if($project->client)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Client</p>
                                        @if($project->client_url)
                                            <a href="{{ $project->client_url }}" target="_blank" class="font-medium text-blue-600 hover:underline">
                                                {{ $project->client }}
                                            </a>
                                        @else
                                            <p class="font-medium">{{ $project->client }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($project->budget)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Budget</p>
                                        <p class="font-medium">{{ $project->formatted_budget }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($project->estimated_hours)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Estimated Hours</p>
                                        <p class="font-medium">{{ number_format($project->estimated_hours) }} hours</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Links Card --}}
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Project Links</h3>
                        
                        <div class="space-y-3">
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" 
                                   class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-blue-50 rounded-lg transition duration-300 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                    <span class="font-medium group-hover:text-blue-600">Live Website</span>
                                </a>
                            @endif

                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" 
                                   class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-gray-200 rounded-lg transition duration-300 group">
                                    <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">GitHub Repository</span>
                                </a>
                            @endif

                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" 
                                   class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-green-50 rounded-lg transition duration-300 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium group-hover:text-green-600">Live Demo</span>
                                </a>
                            @endif

                            @if($project->documentation_url)
                                <a href="{{ $project->documentation_url }}" target="_blank" 
                                   class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-yellow-50 rounded-lg transition duration-300 group">
                                    <svg class="w-5 h-5 text-gray-500 group-hover:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <span class="font-medium group-hover:text-yellow-600">Documentation</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Admin Only Section --}}
                    @if(auth()->check() && $isAdmin)
                        <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl shadow-lg p-6 border border-purple-200">
                            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-purple-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Admin Panel
                            </h3>
                            
                            <div class="space-y-3">
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Status:</span> 
                                    <span class="{{ $project->is_published ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $project->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </p>
                                
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Sort Order:</span> {{ $project->sort_order }}
                                </p>
                                
                                @if($project->user)
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Created by:</span> {{ $project->user->name }}
                                    </p>
                                @endif
                                
                                @if(!empty($project->team_members))
                                    <div>
                                        <p class="font-semibold text-sm mb-2">Team Members:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($project->team_members as $member)
                                                <span class="px-2 py-1 bg-white rounded text-xs text-gray-700">
                                                    {{ $member }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" 
                                       class="flex-1 px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition duration-300 text-center">
                                        Edit Project
                                    </a>
                                    <a href="{{ route('admin.projects.index') }}" 
                                       class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition duration-300">
                                        Back to Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Share Buttons --}}
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Share Project</h3>
                        <div class="flex gap-3">
                            <button onclick="shareProject('facebook')" 
                                    class="flex-1 p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                                <span class="hidden sm:inline">Share</span>
                            </button>
                            <button onclick="shareProject('twitter')" 
                                    class="flex-1 p-3 bg-black text-white rounded-lg hover:bg-gray-800 transition duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                                <span class="hidden sm:inline">Tweet</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Projects --}}
    @if($relatedProjects && $relatedProjects->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Related Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProjects as $related)
                        <a href="{{ route('projects.show', $related->slug) }}" 
                           class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $related->thumbnail_url }}" 
                                     alt="{{ $related->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2 group-hover:text-blue-600 transition duration-300">
                                    {{ $related->title }}
                                </h3>
                                <p class="text-gray-600 line-clamp-2">{{ $related->short_description }}</p>
                                
                                {{-- Related Project Stats --}}
                                <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ number_format($related->view_count) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        {{ number_format($related->likes_count) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>

{{-- Gallery Modal --}}
<div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center">
    <!-- Close button -->
    <button onclick="closeGallery()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10 p-2 rounded-full bg-black bg-opacity-50 hover:bg-opacity-75 transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <!-- Previous button -->
    <button onclick="prevImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10 p-3 rounded-full bg-black bg-opacity-50 hover:bg-opacity-75 transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    
    <!-- Next button -->
    <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10 p-3 rounded-full bg-black bg-opacity-50 hover:bg-opacity-75 transition">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    
    <!-- Image container -->
    <div class="relative w-full h-full flex items-center justify-center p-4">
        <img id="modalImage" src="" alt="Gallery image" class="max-w-full max-h-full object-contain">
    </div>
    
    <!-- Counter -->
    <div class="absolute bottom-4 left-0 right-0 text-center text-white">
        <span id="imageCounter" class="px-4 py-2 bg-black bg-opacity-50 rounded-full text-sm">0 / 0</span>
    </div>
</div>
</x-guest-layout>
{{-- @push('scripts') --}}
<script>
    // Tab switching functionality
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(tabName).classList.remove('hidden');
        
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active', 'border-blue-500', 'text-blue-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Gunakan parameter event atau cari elemen yang diklik
        const activeButton = Array.from(document.querySelectorAll('.tab-button')).find(
            btn => btn.textContent.toLowerCase().includes(tabName)
        );
        
        if (activeButton) {
            activeButton.classList.add('active', 'border-blue-500', 'text-blue-600');
            activeButton.classList.remove('border-transparent', 'text-gray-500');
        }
    }

    // Gallery functionality
    let currentImageIndex = 0;
    let galleryImages = [];
    
    // Inisialisasi galleryImages dari data project
    @if(!empty($project->gallery_urls) && count($project->gallery_urls) > 0)
        galleryImages = @json($project->gallery_urls);
    @else
        galleryImages = [];
    @endif
    
    function openGallery(index) {
        console.log('Opening gallery at index:', index); // Debug
        console.log('Gallery images:', galleryImages); // Debug
        
        if (!galleryImages || galleryImages.length === 0) {
            alert('No gallery images available');
            return;
        }
        
        currentImageIndex = parseInt(index);
        updateGalleryImage();
        
        const modal = document.getElementById('galleryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Tambahkan event listener keyboard
        document.addEventListener('keydown', handleGalleryKeyPress);
    }
    
    function closeGallery() {
        const modal = document.getElementById('galleryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        
        // Hapus event listener keyboard
        document.removeEventListener('keydown', handleGalleryKeyPress);
    }
    
    function updateGalleryImage() {
        if (!galleryImages || galleryImages.length === 0) return;
        
        const modalImage = document.getElementById('modalImage');
        const counter = document.getElementById('imageCounter');
        
        // Validasi index
        if (currentImageIndex < 0) currentImageIndex = 0;
        if (currentImageIndex >= galleryImages.length) currentImageIndex = galleryImages.length - 1;
        
        modalImage.src = galleryImages[currentImageIndex];
        counter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        
        console.log('Showing image:', currentImageIndex + 1, 'of', galleryImages.length); // Debug
    }
    
    function nextImage() {
        if (!galleryImages || galleryImages.length === 0) return;
        
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        updateGalleryImage();
    }
    
    function prevImage() {
        if (!galleryImages || galleryImages.length === 0) return;
        
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        updateGalleryImage();
    }
    
    // Handler untuk keyboard navigation
    function handleGalleryKeyPress(e) {
        if (e.key === 'Escape') {
            closeGallery();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            nextImage();
        } else if (e.key === 'ArrowLeft') {
            e.preventDefault();
            prevImage();
        }
    }
    
    // Share functionality
    function shareProject(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent("{{ $project->title }}");
        
        let shareUrl = '';
        
        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    }

    // Like functionality
    function likeProject() {
        fetch('{{ route("projects.like", $project) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update like count in UI
                const likeCountElements = document.querySelectorAll('.like-count');
                likeCountElements.forEach(element => {
                    element.textContent = data.likes_count;
                });
            }
        })
        .catch(error => {
            console.error('Error liking project:', error);
        });
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, gallery images:', galleryImages); // Debug
        
        // Add like button to stats card
        const statsCard = document.querySelector('.grid-cols-2');
        if (statsCard && !document.querySelector('.like-button-added')) {
            const likeButton = document.createElement('button');
            likeButton.onclick = likeProject;
            likeButton.className = 'like-button-added col-span-2 mt-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition duration-300 flex items-center justify-center gap-2';
            likeButton.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span>Like this project</span>
                <span class="like-count font-bold">({{ number_format($project->likes_count ?? 0) }})</span>
            `;
            statsCard.parentNode.insertBefore(likeButton, statsCard.nextSibling);
        }
        
        // Fix for gallery image click handlers
        const galleryImages = document.querySelectorAll('[onclick^="openGallery"]');
        galleryImages.forEach((img, index) => {
            img.setAttribute('onclick', `openGallery(${index})`);
        });
    });
</script>
{{-- @endpush --}}

{{-- @push('styles') --}}
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
{{-- @endpush --}}

{{-- ============================================= --}}
{{-- END MODIFICATION: Halaman Detail Project Elegant --}}
{{-- ============================================= --}}
