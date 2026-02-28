<x-admin-layout>
    @section('title', 'Projects Management')
    
    <div class="py-6">
        <div class="max-w-full mx-auto">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <!-- Page Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                Projects
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Manage all portfolio projects. Create, edit, and organize your work.
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.home') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('admin.projects.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Project
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <div>
                        <!-- Header Section -->
                        <div class="mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Projects Management</h1>
                                    <p class="text-gray-600 mt-2">Manage and organize your portfolio projects</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                        <button @click="open = !open" 
                                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Quick Actions
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        
                                        <div x-show="open" x-transition 
                                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                                            <div class="py-1">
                                                <a href="{{ route('admin.projects.create') }}" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                        Create New Project
                                                    </div>
                                                </a>
                                                <button type="button" onclick="applyBulkAction()" 
                                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Bulk Publish Selected
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('admin.projects.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <!-- Total Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProjects }}</p>
                                        <p class="text-xs text-gray-500 mt-1">All time projects</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Published Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Published</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $publishedProjects }}</p>
                                        <p class="text-xs text-green-600 mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                            </svg>
                                            {{ $totalProjects > 0 ? round(($publishedProjects / $totalProjects) * 100, 1) : 0 }}%
                                        </p>
                                    </div>
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Featured Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Featured</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $featuredProjects }}</p>
                                        <p class="text-xs text-purple-600 mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            Featured Rate
                                        </p>
                                    </div>
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- In Progress Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">In Progress</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ \App\Models\Project::where('status', 'in_progress')->count() }}</p>
                                        <p class="text-xs text-blue-600 mt-1">Active development</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Filters & Search -->
                        <form id="filterForm" action="{{ route('admin.projects.index') }}" method="GET">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                                <div class="p-6 border-b border-gray-200">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                    </svg>
                                                </div>
                                                <input name="search" 
                                                       value="{{ $search }}"
                                                       type="search" 
                                                       placeholder="Search projects by title, description, or client..."
                                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-3">
                                            <select name="statusFilter" 
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                <option value="">All Status</option>
                                                @foreach($statusOptions as $value => $label)
                                                    <option value="{{ $value }}" {{ $statusFilter == $value ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                    
                                            <select name="featuredFilter" 
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                <option value="">All Projects</option>
                                                <option value="featured" {{ $featuredFilter == 'featured' ? 'selected' : '' }}>Featured Only</option>
                                                <option value="not_featured" {{ $featuredFilter == 'not_featured' ? 'selected' : '' }}>Not Featured</option>
                                            </select>
                    
                                            <select name="publishedFilter" 
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                <option value="">All Visibility</option>
                                                <option value="published" {{ $publishedFilter == 'published' ? 'selected' : '' }}>Published Only</option>
                                                <option value="draft" {{ $publishedFilter == 'draft' ? 'selected' : '' }}>Draft Only</option>
                                            </select>
                    
                                            <select name="perPage" 
                                                    onchange="document.getElementById('filterForm').submit()"
                                                    class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
                                            </select>
                                            
                                            <!-- Hidden fields for sorting -->
                                            <input type="hidden" name="sortField" value="{{ $sortField }}">
                                            <input type="hidden" name="sortDirection" value="{{ $sortDirection }}">
                                            
                                            <button type="button" onclick="clearFilters()" 
                                                    class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                                Clear Filters
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Active Filters Badges -->
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        @if($search)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Search: "{{ $search }}"
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('search'), ['search' => ''])) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                        
                                        @if($statusFilter)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Status: {{ $statusOptions[$statusFilter] ?? $statusFilter }}
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('statusFilter'), ['statusFilter' => ''])) }}" class="ml-2 text-green-600 hover:text-green-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                        
                                        @if($featuredFilter === 'featured')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Featured Only
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('featuredFilter'), ['featuredFilter' => ''])) }}" class="ml-2 text-purple-600 hover:text-purple-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                        
                                        @if($featuredFilter === 'not_featured')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Not Featured
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('featuredFilter'), ['featuredFilter' => ''])) }}" class="ml-2 text-gray-600 hover:text-gray-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif

                                        @if($publishedFilter === 'published')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Published Only
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('publishedFilter'), ['publishedFilter' => ''])) }}" class="ml-2 text-green-600 hover:text-green-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                        
                                        @if($publishedFilter === 'draft')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Draft Only
                                                <a href="{{ route('admin.projects.index', array_merge(request()->except('publishedFilter'), ['publishedFilter' => ''])) }}" class="ml-2 text-yellow-600 hover:text-yellow-800">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                    
                                <!-- Bulk Actions -->
                                @if(count($selectedProjects ?? []) > 0)
                                <div id="bulkActionsSection" class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-medium text-blue-800">
                                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span id="selectedCount">0</span> project(s) selected
                                            </span>
                                            <div class="flex items-center gap-2">
                                                <select id="bulkActionSelect" 
                                                        class="block w-48 border-blue-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                    <option value="">Choose action...</option>
                                                    <option value="publish">Publish Selected</option>
                                                    <option value="unpublish">Unpublish Selected</option>
                                                    <option value="feature">Feature Selected</option>
                                                    <option value="unfeature">Unfeature Selected</option>
                                                    <option value="delete" class="text-red-600">Delete Selected</option>
                                                </select>
                                                <button type="button" onclick="applyBulkAction()" 
                                                        id="applyBulkActionBtn"
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    Apply
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" onclick="clearSelection()" 
                                                class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            Clear selection
                                        </button>
                                    </div>
                                </div>
                                @endif
                    
                                <!-- Projects Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="w-8 px-6 py-3 text-left">
                                                    <input type="checkbox" 
                                                           id="selectAllCheckbox"
                                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortBy('title')">
                                                    <div class="flex items-center">
                                                        Project
                                                        @if($sortField === 'title')
                                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortBy('status')">
                                                    <div class="flex items-center">
                                                        Status
                                                        @if($sortField === 'status')
                                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortBy('is_published')">
                                                    <div class="flex items-center">
                                                        Visibility
                                                        @if($sortField === 'is_published')
                                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Technologies
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortBy('view_count')">
                                                    <div class="flex items-center">
                                                        Views
                                                        @if($sortField === 'view_count')
                                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortBy('created_at')">
                                                    <div class="flex items-center">
                                                        Created
                                                        @if($sortField === 'created_at')
                                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($projects as $project)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150" data-project-id="{{ $project->id }}">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="checkbox" 
                                                               value="{{ $project->id }}"
                                                               class="project-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-12 w-12">
                                                                @if($project->thumbnail_url)
                                                                    <img class="h-12 w-12 rounded-lg object-cover border border-gray-200" 
                                                                         src="{{ $project->thumbnail_url }}" 
                                                                         alt="{{ $project->title }}"
                                                                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"%23d1d5db\"%3E%3Cpath d=\"M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10\" stroke=\"%239ca3af\" stroke-width=\"1\"%3E%3C/path%3E%3C/svg%3E'">
                                                                @else
                                                                    <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-semibold text-gray-900">
                                                                    <a href="{{ route('projects.show', $project) }}" class="hover:text-blue-600 transition-colors">
                                                                        {{ $project->title }}
                                                                    </a>
                                                                </div>
                                                                <div class="text-sm text-gray-500 truncate max-w-xs">
                                                                    {{ $project->short_description }}
                                                                </div>
                                                                @if($project->client)
                                                                    <div class="text-xs text-gray-400 mt-1">
                                                                        Client: {{ $project->client }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex flex-col gap-1">
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                @if($project->status == 'completed') bg-green-100 text-green-800
                                                                @elseif($project->status == 'in_progress') bg-blue-100 text-blue-800
                                                                @elseif($project->status == 'planned') bg-yellow-100 text-yellow-800
                                                                @elseif($project->status == 'on_hold') bg-red-100 text-red-800
                                                                @else bg-gray-100 text-gray-800 @endif">
                                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                                            </span>
                                                            @if($project->is_featured)
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 mt-1">
                                                                    Featured
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($project->is_published)
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                Published
                                                            </span>
                                                        @else
                                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                                </svg>
                                                                Draft
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @if($project->technologies && count($project->technologies) > 0)
                                                            <div class="flex flex-wrap gap-1 max-w-xs">
                                                                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                                                        {{ $tech }}
                                                                    </span>
                                                                @endforeach
                                                                @if(count($project->technologies) > 3)
                                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-600 rounded">
                                                                        +{{ count($project->technologies) - 3 }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-sm text-gray-400">No technologies</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                            <span class="text-sm font-medium text-gray-900">
                                                                {{ number_format($project->view_count) }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="flex flex-col">
                                                            <span>{{ $project->created_at->format('M d, Y') }}</span>
                                                            <span class="text-xs text-gray-400">{{ $project->created_at->format('h:i A') }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center gap-2">
                                                            <!-- Preview Button -->
                                                            <a href="{{ route('projects.show', $project->id) }}" 
                                                                target="_blank"
                                                                class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                                title="Preview">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                </svg>
                                                            </a>
                                                            
                                                            <!-- Show Button -->
                                                            <a href="{{ route('admin.projects.show', $project) }}" 
                                                               class="p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors"
                                                               title="View Details">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            </a>
                                                            
                                                            <!-- Edit Button -->
                                                            <a href="{{ route('admin.projects.edit', $project) }}" 
                                                               class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                               title="Edit">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                            </a>
                                                            
                                                            <!-- Delete Button -->
                                                            <!-- Delete Button - TAMBAHKAN event.preventDefault() -->
                                                                <a href="#" 
                                                                onclick="event.preventDefault(); showDeleteModal({{ $project->id }}, '{{ addslashes($project->title) }}')"
                                                                class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                                title="Delete">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                                </a>
                                                            {{-- <button onclick="confirmDelete({{ $project->id }})" 
                                                                    class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                                    title="Delete">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="px-6 py-12 text-center">
                                                        <div class="text-gray-500">
                                                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                            </svg>
                                                            <h3 class="mt-4 text-lg font-medium text-gray-900">No projects found</h3>
                                                            <p class="mt-1 text-sm text-gray-500 max-w-md mx-auto">
                                                                @if($search || $statusFilter || $featuredFilter || $publishedFilter)
                                                                    Try changing your filters or search query
                                                                @else
                                                                    Get started by creating your first project
                                                                @endif
                                                            </p>
                                                            <div class="mt-6 space-x-3">
                                                                @if($search || $statusFilter || $featuredFilter || $publishedFilter)
                                                                    <a href="{{ route('admin.projects.index') }}" 
                                                                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                        Clear Filters
                                                                    </a>
                                                                @endif
                                                                <a href="{{ route('admin.projects.create') }}" 
                                                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                    </svg>
                                                                    Add Project
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                    
                                <!-- Pagination -->
                                @if($projects->hasPages())
                                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                                                Showing 
                                                <span class="font-medium">{{ $projects->firstItem() }}</span>
                                                to 
                                                <span class="font-medium">{{ $projects->lastItem() }}</span>
                                                of 
                                                <span class="font-medium">{{ $projects->total() }}</span>
                                                results
                                            </div>
                                            
                                            <div class="flex items-center space-x-2">
                                                {{ $projects->appends(request()->except('page'))->links() }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <!-- Delete Confirmation Modal - DIPERBAIKI STRUKTUR -->
    <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Trick to center modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <!-- Modal panel - TAMBAHKAN onclick="event.stopPropagation()" -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" onclick="event.stopPropagation()">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Project
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete the project 
                                    <span id="projectTitle" class="font-semibold"></span>?
                                    This action cannot be undone and all associated data will be permanently removed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                id="deleteButton"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" 
                            onclick="hideDeleteModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Project
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this project? This action cannot be undone and all associated data will be permanently removed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                id="deleteButton"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" 
                            onclick="hideDeleteModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        // JavaScript untuk meng-handle fungsi-fungsi yang sebelumnya di Livewire
        let selectedProjects = [];
        // let deleteProjectId = null;

        // Toggle select all
        document.getElementById('selectAllCheckbox')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.project-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedProjects();
        });

        // Update selected projects ketika checkbox berubah
        document.querySelectorAll('.project-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedProjects);
        });

        function updateSelectedProjects() {
            selectedProjects = [];
            const checkboxes = document.querySelectorAll('.project-checkbox:checked');
            checkboxes.forEach(checkbox => {
                selectedProjects.push(checkbox.value);
            });
            
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const totalCheckboxes = document.querySelectorAll('.project-checkbox').length;
            
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = selectedProjects.length === totalCheckboxes && totalCheckboxes > 0;
                selectAllCheckbox.indeterminate = selectedProjects.length > 0 && selectedProjects.length < totalCheckboxes;
            }
            
            // Update UI untuk bulk actions
            updateBulkActionsUI();
        }

        function updateBulkActionsUI() {
            const selectedCount = selectedProjects.length;
            const selectedCountElement = document.getElementById('selectedCount');
            const bulkActionsSection = document.getElementById('bulkActionsSection');
            const applyBulkActionBtn = document.getElementById('applyBulkActionBtn');
            
            if (selectedCountElement) {
                selectedCountElement.textContent = selectedCount;
            }
            
            if (bulkActionsSection) {
                if (selectedCount > 0) {
                    bulkActionsSection.classList.remove('hidden');
                } else {
                    bulkActionsSection.classList.add('hidden');
                }
            }
            
            if (applyBulkActionBtn) {
                applyBulkActionBtn.disabled = selectedCount === 0;
            }
        }

        function clearSelection() {
            document.querySelectorAll('.project-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            document.getElementById('selectAllCheckbox').checked = false;
            document.getElementById('selectAllCheckbox').indeterminate = false;
            selectedProjects = [];
            updateBulkActionsUI();
        }

        function sortBy(field) {
            const form = document.getElementById('filterForm');
            const currentField = form.querySelector('input[name="sortField"]').value;
            const currentDirection = form.querySelector('input[name="sortDirection"]').value;
            
            let newDirection = 'asc';
            if (currentField === field) {
                newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
            }
            
            form.querySelector('input[name="sortField"]').value = field;
            form.querySelector('input[name="sortDirection"]').value = newDirection;
            form.submit();
        }

        function clearFilters() {
            window.location.href = "{{ route('admin.projects.index') }}";
        }

        function applyBulkAction() {
            const action = document.getElementById('bulkActionSelect').value;
            if (!action || selectedProjects.length === 0) {
                alert('Please select an action and at least one project.');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Are you sure you want to delete ' + selectedProjects.length + ' project(s)? This action cannot be undone.')) {
                    return;
                }
            }
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('admin.projects.bulk-action') }}";
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);
            
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);
            
            selectedProjects.forEach(projectId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_projects[]';
                input.value = projectId;
                form.appendChild(input);
            });
            
            document.body.appendChild(form);
            form.submit();
        }

        // function confirmDelete(projectId) {
        //     deleteProjectId = projectId;
        //     const deleteForm = document.getElementById('deleteForm');
        //     deleteForm.action = "{{ route('admin.projects.destroy', ':id') }}".replace(':id', projectId);
        //     document.getElementById('deleteModal').classList.remove('hidden');
        // }

        function showDeleteModal(projectId, projectTitle, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = "{{ route('admin.projects.destroy', ':id') }}".replace(':id', projectId);
            document.getElementById('projectTitle').textContent = projectTitle;
            
            // TAMBAHKAN INI:
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.classList.add('modal-open'); // LOCK BODY SCROLL
            
            return false;
        }


        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('deleteModal');
            
            // Tutup modal ketika klik di background
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideDeleteModal();
                }
            });
            
            // Tutup modal dengan tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    hideDeleteModal();
                }
            });
            
            // Update bulk actions UI
            updateBulkActionsUI();
        });

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('modal-open'); // UNLOCK BODY SCROLL
        }

    </script>
</x-admin-layout>

{{-- <x-admin-layout>
    @section('title', 'Projects Managemenet')
    <h1 class="text-xl font-semibold text-second">
        @yield('title', 'Dashboard')
    </h1>
    <div class="py-6">
        <div class="max-w-full mx-auto">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <!-- Page Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                                Projects
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Manage all portfolio projects. Create, edit, and organize your work.
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.home') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Dashboard
                            </a>
                            <a href="{{ route('admin.projects.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Project
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Livewire Component -->
                <div class="p-6">
                    <div>
                        <!-- Header Section -->
                        <div class="mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Projects Management</h1>
                                    <p class="text-gray-600 mt-2">Manage and organize your portfolio projects</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                                        <button @click="open = !open" 
                                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Quick Actions
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        
                                        <div x-show="open" x-transition 
                                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                                            <div class="py-1">
                                                <a href="{{ route('admin.projects.create') }}" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                        Create New Project
                                                    </div>
                                                </a>
                                                <a href="#" wire:click.prevent="applyBulkAction" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Bulk Publish Selected
                                                    </div>
                                                </a>
                                                <a href="#" wire:click.prevent="exportProjects" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                        </svg>
                                                        Export Projects
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('admin.projects.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Add Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <!-- Total Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProjects }}</p>
                                        <p class="text-xs text-gray-500 mt-1">All time projects</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Published Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Published</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $publishedProjects }}</p>
                                        <p class="text-xs text-green-600 mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                            </svg>
                                            {{ $totalProjects > 0 ? round(($publishedProjects / $totalProjects) * 100, 1) : 0 }}%
                                        </p>
                                    </div>
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Featured Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Featured</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $featuredProjects }}</p>
                                        <p class="text-xs text-purple-600 mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            Featured Rate
                                        </p>
                                    </div>
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- In Progress Projects -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">In Progress</p>
                                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ App\Models\Project::where('status', 'in_progress')->count() }}</p>
                                        <p class="text-xs text-blue-600 mt-1">Active development</p>
                                    </div>
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Filters & Search -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <input wire:model.live.debounce.300ms="search" 
                                                   type="search" 
                                                   placeholder="Search projects by title, description, or client..."
                                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-wrap items-center gap-3">
                                        <select wire:model.live="statusFilter" 
                                                class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                            <option value="">All Status</option>
                                            @foreach($statusOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                    
                                        <select wire:model.live="featuredFilter" 
                                                class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                            <option value="">All Projects</option>
                                            <option value="featured">Featured Only</option>
                                            <option value="not_featured">Not Featured</option>
                                        </select>
                    
                                        <select wire:model.live="perPage" 
                                                class="block w-full md:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                            <option value="10">10 per page</option>
                                            <option value="25">25 per page</option>
                                            <option value="50">50 per page</option>
                                            <option value="100">100 per page</option>
                                        </select>
                                        
                                        <button wire:click="$set('search', '')" 
                                                wire:loading.attr="disabled"
                                                class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                            Clear Filters
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Active Filters Badges -->
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @if($search)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Search: "{{ $search }}"
                                            <button wire:click="$set('search', '')" class="ml-2 text-blue-600 hover:text-blue-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                    
                                    @if($statusFilter)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Status: {{ $statusOptions[$statusFilter] ?? $statusFilter }}
                                            <button wire:click="$set('statusFilter', '')" class="ml-2 text-green-600 hover:text-green-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                    
                                    @if($featuredFilter === 'featured')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Featured Only
                                            <button wire:click="$set('featuredFilter', '')" class="ml-2 text-purple-600 hover:text-purple-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                    
                                    @if($featuredFilter === 'not_featured')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Not Featured
                                            <button wire:click="$set('featuredFilter', '')" class="ml-2 text-gray-600 hover:text-gray-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </div>
                            </div>
                    
                            <!-- Bulk Actions -->
                            @if(count($selectedProjects) > 0)
                                <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-medium text-blue-800">
                                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ count($selectedProjects) }} project(s) selected
                                            </span>
                                            <div class="flex items-center gap-2">
                                                <select wire:model="bulkAction" 
                                                        class="block w-48 border-blue-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2">
                                                    <option value="">Choose action...</option>
                                                    <option value="publish">Publish Selected</option>
                                                    <option value="unpublish">Unpublish Selected</option>
                                                    <option value="feature">Feature Selected</option>
                                                    <option value="unfeature">Unfeature Selected</option>
                                                    <option value="delete" class="text-red-600">Delete Selected</option>
                                                </select>
                                                <button wire:click="applyBulkAction" 
                                                        wire:confirm="Are you sure you want to apply this action to selected projects?"
                                                        wire:loading.attr="disabled"
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <span wire:loading.remove wire:target="applyBulkAction">Apply</span>
                                                    <span wire:loading wire:target="applyBulkAction" class="flex items-center">
                                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Processing...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <button wire:click="$set('selectedProjects', [])" 
                                                class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            Clear selection
                                        </button>
                                    </div>
                                </div>
                            @endif
                    
                            <!-- Projects Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="w-8 px-6 py-3 text-left">
                                                <input type="checkbox" 
                                                       wire:model.live="selectAll"
                                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('title')">
                                                <div class="flex items-center">
                                                    Project
                                                    @if($sortField === 'title')
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('status')">
                                                <div class="flex items-center">
                                                    Status
                                                    @if($sortField === 'status')
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('is_published')">
                                                <div class="flex items-center">
                                                    Visibility
                                                    @if($sortField === 'is_published')
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Technologies
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('view_count')">
                                                <div class="flex items-center">
                                                    Views
                                                    @if($sortField === 'view_count')
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                                <div class="flex items-center">
                                                    Created
                                                    @if($sortField === 'created_at')
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($projects as $project)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150 {{ in_array($project->id, $selectedProjects) ? 'bg-blue-50' : '' }}">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="checkbox" 
                                                           value="{{ $project->id }}"
                                                           wire:model.live="selectedProjects"
                                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-12 w-12">
                                                            @if($project->thumbnail_url)
                                                                <img class="h-12 w-12 rounded-lg object-cover border border-gray-200" 
                                                                     src="{{ $project->thumbnail_url }}" 
                                                                     alt="{{ $project->title }}"
                                                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"%23d1d5db\"%3E%3Cpath d=\"M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10\" stroke=\"%239ca3af\" stroke-width=\"1\"%3E%3C/path%3E%3C/svg%3E'">
                                                            @else
                                                                <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-semibold text-gray-900">
                                                                <a href="{{ route('admin.projects.show', $project) }}" class="hover:text-blue-600 transition-colors">
                                                                    {{ $project->title }}
                                                                </a>
                                                            </div>
                                                            <div class="text-sm text-gray-500 truncate max-w-xs">
                                                                {{ $project->short_description }}
                                                            </div>
                                                            @if($project->client)
                                                                <div class="text-xs text-gray-400 mt-1">
                                                                    Client: {{ $project->client }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex flex-col gap-1">
                                                        {!! $project->status_badge !!}
                                                        @if($project->is_featured)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 mt-1">
                                                                Featured
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($project->is_published)
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Published
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                            </svg>
                                                            Draft
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if($project->technologies && count($project->technologies) > 0)
                                                        <div class="flex flex-wrap gap-1 max-w-xs">
                                                            @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                                                    {{ $tech }}
                                                                </span>
                                                            @endforeach
                                                            @if(count($project->technologies) > 3)
                                                                <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-600 rounded">
                                                                    +{{ count($project->technologies) - 3 }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span class="text-sm text-gray-400">No technologies</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        <span class="text-sm font-medium text-gray-900">
                                                            {{ number_format($project->view_count) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex flex-col">
                                                        <span>{{ $project->created_at->format('M d, Y') }}</span>
                                                        <span class="text-xs text-gray-400">{{ $project->created_at->format('h:i A') }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center gap-2">
                                                        <!-- Preview Button -->
                                                        <a href="{{ route('projects.show', $project) }}" 
                                                            target="_blank"
                                                            class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                            title="Preview">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                        </a>
                                                        
                                                        <!-- Show Button -->
                                                        <a href="{{ route('admin.projects.show', $project) }}" 
                                                           class="p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors"
                                                           title="View Details">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </a>
                                                        
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.projects.edit', $project) }}" 
                                                           class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                           title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                            </svg>
                                                        </a>
                                                        
                                                        <!-- Delete Button -->
                                                        <button wire:click="confirmDelete({{ $project->id }})" 
                                                                class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                                title="Delete">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="px-6 py-12 text-center">
                                                    <div class="text-gray-500">
                                                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                        </svg>
                                                        <h3 class="mt-4 text-lg font-medium text-gray-900">No projects found</h3>
                                                        <p class="mt-1 text-sm text-gray-500 max-w-md mx-auto">
                                                            @if($search || $statusFilter || $featuredFilter)
                                                                Try changing your filters or search query
                                                            @else
                                                                Get started by creating your first project
                                                            @endif
                                                        </p>
                                                        <div class="mt-6 space-x-3">
                                                            @if($search || $statusFilter || $featuredFilter)
                                                                <button wire:click="clearFilters" 
                                                                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                    Clear Filters
                                                                </button>
                                                            @endif
                                                            <a href="{{ route('admin.projects.create') }}" 
                                                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                </svg>
                                                                Add Project
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                    
                            <!-- Pagination -->
                            @if($projects->hasPages())
                                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                                            Showing 
                                            <span class="font-medium">{{ $projects->firstItem() }}</span>
                                            to 
                                            <span class="font-medium">{{ $projects->lastItem() }}</span>
                                            of 
                                            <span class="font-medium">{{ $projects->total() }}</span>
                                            results
                                        </div>
                                        
                                        <div class="flex items-center space-x-2">
                                            {{ $projects->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    
                        <!-- Delete Confirmation Modal -->
                        @if($showDeleteModal)
                            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    
                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                        Delete Project
                                                    </h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            Are you sure you want to delete this project? This action cannot be undone and all associated data will be permanently removed.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="button" 
                                                    wire:click="deleteProject"
                                                    wire:loading.attr="disabled"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                                <span wire:loading.remove wire:target="deleteProject">Delete</span>
                                                <span wire:loading wire:target="deleteProject" class="flex items-center">
                                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    Deleting...
                                                </span>
                                            </button>
                                            <button type="button" 
                                                    wire:click="$set('showDeleteModal', false)"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> --}}