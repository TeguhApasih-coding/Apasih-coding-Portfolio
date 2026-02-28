{{-- resources/views/projects/index.blade.php --}}
{{-- @extends('layouts.app')

@section('title', 'My Portfolio - Projects Showcase')
@section('meta_description', 'Explore my portfolio of web development projects showcasing various technologies and solutions')

@section('content') --}}
{{-- ============================================= --}}
{{-- START MODIFICATION: Halaman Portfolio Grid --}}
{{-- ============================================= --}}
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white font-montser">
        
        {{-- Hero Section --}}
        <section class="relative bg-gradient-to-r from-second to-blue-102 py-20 overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute left-0 top-0 h-full w-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="20" cy="20" r="2" fill="white"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern)"/>
                </svg>
            </div>
            
            <div class="relative container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    My Portfolio
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Explore my latest projects and see how I transform ideas into reality
                </p>
                
                {{-- Stats Counter --}}
                <div class="flex justify-center gap-8 mt-12 text-white">
                    <div class="text-center">
                        <div class="text-3xl font-bold">{{ $projects->total() }}</div>
                        <div class="text-sm text-blue-200">Total Projects</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">
                            {{ App\Models\Project::where('is_featured', true)->count() }}
                        </div>
                        <div class="text-sm text-blue-200">Featured</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold">
                            {{ App\Models\Project::sum('view_count') }}
                        </div>
                        <div class="text-sm text-blue-200">Total Views</div>
                    </div>
                </div>
            </div>
            
            {{-- Wave Divider --}}
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
                </svg>
            </div>
        </section>

        {{-- Filter and Search Section --}}
        <section class="py-8 bg-white shadow-sm sticky top-0 z-30">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    
                    {{-- Search Form --}}
                    <div class="w-full md:w-96">
                        <form action="{{ route('projects.search') }}" method="GET" class="relative">
                            <input type="text" 
                                name="q" 
                                value="{{ request('q') }}"
                                placeholder="Search projects..." 
                                class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300">
                            <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            @if(request('q'))
                                <a href="{{ route('projects.index') }}" 
                                class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            @endif
                        </form>
                    </div>
                    
                    {{-- Filter Buttons --}}
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="{{ route('projects.index') }}" 
                        class="px-4 py-2 rounded-lg {{ !request('filter') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-300">
                            All Projects
                        </a>
                        <a href="{{ route('projects.index', ['filter' => 'featured']) }}" 
                        class="px-4 py-2 rounded-lg {{ request('filter') == 'featured' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-300">
                            <span class="flex items-center gap-1">
                                ⭐ Featured
                            </span>
                        </a>
                        <a href="{{ route('projects.index', ['filter' => 'completed']) }}" 
                        class="px-4 py-2 rounded-lg {{ request('filter') == 'completed' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-300">
                            Completed
                        </a>
                        <a href="{{ route('projects.index', ['filter' => 'in_progress']) }}" 
                        class="px-4 py-2 rounded-lg {{ request('filter') == 'in_progress' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-300">
                            In Progress
                        </a>
                    </div>
                    
                    {{-- Sort Options --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            <span>Sort</span>
                        </button>
                        
                        <div x-show="open" 
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-40">
                            <a href="{{ route('projects.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" 
                            class="block px-4 py-2 hover:bg-gray-50 {{ request('sort') == 'newest' ? 'text-blue-600 font-medium' : '' }}">
                                Newest First
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->query(), ['sort' => 'oldest'])) }}" 
                            class="block px-4 py-2 hover:bg-gray-50 {{ request('sort') == 'oldest' ? 'text-blue-600 font-medium' : '' }}">
                                Oldest First
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" 
                            class="block px-4 py-2 hover:bg-gray-50 {{ request('sort') == 'popular' ? 'text-blue-600 font-medium' : '' }}">
                                Most Viewed
                            </a>
                            <a href="{{ route('projects.index', array_merge(request()->query(), ['sort' => 'name'])) }}" 
                            class="block px-4 py-2 hover:bg-gray-50 {{ request('sort') == 'name' ? 'text-blue-600 font-medium' : '' }}">
                                Name A-Z
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Active Filters --}}
                @if(request('filter') || request('q') || request('sort'))
                    <div class="mt-4 flex items-center gap-2 text-sm">
                        <span class="text-gray-500">Active filters:</span>
                        @if(request('q'))
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full flex items-center gap-1">
                                Search: "{{ request('q') }}"
                                <a href="{{ route('projects.index', array_merge(request()->except('q'), ['page' => null])) }}" class="hover:text-blue-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('filter'))
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full flex items-center gap-1">
                                Filter: {{ ucfirst(str_replace('_', ' ', request('filter'))) }}
                                <a href="{{ route('projects.index', request()->except('filter')) }}" class="hover:text-purple-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('sort'))
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full flex items-center gap-1">
                                Sort: {{ ucfirst(request('sort')) }}
                                <a href="{{ route('projects.index', request()->except('sort')) }}" class="hover:text-green-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        
                        <a href="{{ route('projects.index') }}" class="text-red-500 hover:text-red-700 ml-2">
                            Clear all
                        </a>
                    </div>
                @endif
            </div>
        </section>

        {{-- Projects Grid --}}
        <section class="py-16">
            <div class="container mx-auto px-4">
                
                @if($projects->count() > 0)
                    {{-- Grid Layout --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($projects as $project)
                            <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                
                                {{-- Project Image --}}
                                <div class="relative h-56 overflow-hidden">
                                    <img src="{{ $project->thumbnail_url }}" 
                                        alt="{{ $project->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        onerror="this.onerror=null; this.src='{{ asset('images/default-project.jpg') }}'">
                                    
                                    {{-- Overlay Gradient --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                    
                                    {{-- Featured Badge --}}
                                    @if($project->is_featured)
                                        <div class="absolute top-4 left-4">
                                            <span class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-full text-xs font-semibold flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                Featured
                                            </span>
                                        </div>
                                    @endif
                                    
                                    {{-- Status Badge --}}
                                    <div class="absolute top-4 right-4">
                                        {!! $project->status_badge !!}
                                    </div>
                                    
                                    {{-- Quick View Button --}}
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <a href="{{ route('projects.show', $project->slug) }}" 
                                        class="px-6 py-3 bg-white text-gray-900 rounded-full font-semibold transform translate-y-4 group-hover:translate-y-0 transition duration-300 shadow-lg hover:bg-blue-600 hover:text-white">
                                            View Project
                                        </a>
                                    </div>
                                </div>
                                
                                {{-- Project Info --}}
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2 group-hover:text-blue-600 transition duration-300">
                                        <a href="{{ route('projects.show', $project->slug) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h3>
                                    
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $project->short_description }}
                                    </p>
                                    
                                    {{-- Technologies --}}
                                    @if($project->technologies)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                            @if(count($project->technologies) > 3)
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                                    +{{ count($project->technologies) - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    {{-- Meta Info --}}
                                    <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                        <div class="flex items-center gap-4">
                                            @if($project->view_count > 0)
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    {{ number_format($project->view_count) }}
                                                </span>
                                            @endif
                                            
                                            @if($project->likes_count > 0)
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                    {{ number_format($project->likes_count) }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($project->duration)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $project->duration }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Hover Effect Border --}}
                                <div class="absolute inset-0 border-2 border-transparent group-hover:border-blue-500 rounded-2xl transition duration-300 pointer-events-none"></div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Pagination --}}
                    <div class="mt-12">
                        {{ $projects->withQueryString()->links() }}
                    </div>
                    
                @else
                    {{-- Empty State --}}
                    <div class="text-center py-20">
                        <div class="mb-6">
                            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Projects Found</h3>
                        <p class="text-gray-600 mb-6">No projects match your current filters. Try adjusting your search criteria.</p>
                        <a href="{{ route('projects.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Clear Filters
                        </a>
                    </div>
                @endif
            </div>
        </section>
        
        {{-- Call to Action --}}
        <section class="py-20 bg-gradient-to-br from-blue-102 to-second">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Interested in Working Together?
                </h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    {{-- <a href="/contact" 
                    class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 shadow-lg hover:shadow-xl">
                        Get In Touch
                    </a> --}}
                    <button onclick="openModal()" class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 shadow-lg hover:shadow-xl">Get In Touch</button>
                    <a href="{{ route('projects.index') }}" 
                    class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                        View More Projects
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>


@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Custom Pagination Styling */
    .pagination {
        @apply flex justify-center gap-2;
    }
    
    .pagination .page-item {
        @apply inline-block;
    }
    
    .pagination .page-link {
        @apply px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-300;
    }
    
    .pagination .active .page-link {
        @apply bg-blue-600 border-blue-600 text-white;
    }
    
    .pagination .disabled .page-link {
        @apply bg-gray-100 text-gray-400 cursor-not-allowed;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

{{-- ============================================= --}}
{{-- END MODIFICATION: Halaman Portfolio Grid --}}
{{-- ============================================= --}}
