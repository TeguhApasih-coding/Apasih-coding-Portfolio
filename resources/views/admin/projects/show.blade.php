<x-admin-layout>
    @section('title', $project->title . ' - Project Details')
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header dengan Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <a href="{{ route('admin.projects.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Projects</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($project->title, 30) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $project->title }}</h1>
                    <p class="text-gray-600 mt-2">{{ $project->short_description }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.projects.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Projects
                    </a>
                    <a href="{{ route('admin.projects.edit', $project) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Project
                    </a>
                    <a href="{{ route('projects.show', $project) }}" 
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Live
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Project Details</h2>
                            <p class="text-sm text-gray-500 mt-1">Complete information about this project</p>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 lg:mt-0">
                            <!-- Status Badges -->
                            <div class="flex items-center space-x-2">
                                @if($project->is_published)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @endif
                                
                                @if($project->is_featured)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Featured
                                    </span>
                                @endif
                                
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($project->status == 'completed') bg-green-100 text-green-800
                                    @elseif($project->status == 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($project->status == 'planned') bg-yellow-100 text-yellow-800
                                    @elseif($project->status == 'on_hold') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Two Column Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Main Info -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Thumbnail Image -->
                            @if($project->thumbnail_url)
                                <div class="rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ $project->thumbnail_url }}" 
                                         alt="{{ $project->title }}"
                                         class="w-full h-64 object-cover"
                                         onerror="this.src='https://via.placeholder.com/800x400?text=No+Image+Available'">
                                </div>
                            @endif

                            <!-- Description -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                                <div class="prose max-w-none text-gray-700">
                                    {!! nl2br(e($project->description)) !!}
                                </div>
                            </div>

                            <!-- Gallery Images -->
                            @if($project->gallery)
                                @php
                                    // Decode gallery dengan benar
                                    $galleryImages = [];
                                    
                                    // Cek tipe data gallery
                                    if (is_string($project->gallery)) {
                                        // Coba decode JSON
                                        $decoded = json_decode($project->gallery, true);
                                        if (is_array($decoded)) {
                                            $galleryImages = $decoded;
                                        } elseif (!empty($project->gallery)) {
                                            // Jika string biasa (mungkin path file tunggal)
                                            $galleryImages = [$project->gallery];
                                        }
                                    } elseif (is_array($project->gallery)) {
                                        $galleryImages = $project->gallery;
                                    }
                                    
                                    // Filter array kosong
                                    $galleryImages = array_filter($galleryImages);
                                    
                                    // Untuk debugging (hapus setelah selesai)
                                    // \Log::info('Gallery Images:', ['images' => $galleryImages]);
                                @endphp
                                
                                @if(count($galleryImages) > 0)
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gallery ({{ count($galleryImages) }} images)</h3>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach($galleryImages as $index => $image)
                                                @if(!empty($image))
                                                    @php
                                                        // Buat URL gambar yang benar
                                                        $imageUrl = $image;
                                                        
                                                        // Jika bukan URL eksternal (tidak dimulai dengan http)
                                                        if (!str_starts_with($image, 'http')) {
                                                            // Hapus 'public/' jika ada di path
                                                            $cleanPath = str_replace('public/', '', $image);
                                                            $imageUrl = asset('storage/' . $cleanPath);
                                                        }
                                                    @endphp
                                                    
                                                    <div class="rounded-lg overflow-hidden border border-gray-200 group cursor-pointer" 
                                                         onclick="openImageModal('{{ $imageUrl }}')">
                                                        <div class="relative">
                                                            <img src="{{ $imageUrl }}" 
                                                                 alt="Gallery image {{ $index + 1 }}"
                                                                 class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300"
                                                                 onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}'; this.parentElement.parentElement.classList.add('border-red-200');">
                                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300 flex items-center justify-center">
                                                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <!-- Tampilkan pesan jika tidak ada gallery -->
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gallery</h3>
                                        <p class="text-gray-500 italic">No gallery images available for this project.</p>
                                    </div>
                                @endif
                            @else
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Gallery</h3>
                                    <p class="text-gray-500 italic">No gallery images available for this project.</p>
                                </div>
                            @endif
                            {{-- @if($project->gallery && count($project->gallery) > 0)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Gallery</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($project->gallery as $image)
                                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                                <img src="{{ $image }}" 
                                                     alt="Gallery image {{ $loop->iteration }}"
                                                     class="w-full h-32 object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                                     onclick="openImageModal('{{ $image }}')">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif --}}
                        </div>

                        <!-- Right Column - Sidebar Info -->
                        <div class="space-y-6">
                            <!-- Stats Card -->
                            <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                                <h3 class="text-lg font-semibold text-blue-900 mb-4">Project Stats</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-blue-700">Views</span>
                                        <span class="font-semibold text-blue-900">{{ number_format($project->view_count) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-blue-700">Created</span>
                                        <span class="font-semibold text-blue-900">{{ $project->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-blue-700">Last Updated</span>
                                        <span class="font-semibold text-blue-900">{{ $project->updated_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($project->start_date)
                                        <div class="flex justify-between items-center">
                                            <span class="text-blue-700">Start Date</span>
                                            <span class="font-semibold text-blue-900">{{ $project->start_date->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                    @if($project->end_date)
                                        <div class="flex justify-between items-center">
                                            <span class="text-blue-700">End Date</span>
                                            <span class="font-semibold text-blue-900">{{ $project->end_date->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Client Info -->
                            @if($project->client)
                                <div class="bg-white rounded-lg p-6 border border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Client Information</h3>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="text-gray-700">{{ $project->client }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Technologies -->
                            @if($project->technologies && count($project->technologies) > 0)
                                <div class="bg-white rounded-lg p-6 border border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Technologies Used</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project->technologies as $tech)
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Skills -->
                            @if($project->skills && $project->skills->count() > 0)
                                <div class="bg-white rounded-lg p-6 border border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Related Skills</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project->skills as $skill)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="bg-white rounded-lg p-6 border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                                <div class="space-y-3">
                                    <a href="{{ route('admin.projects.edit', $project) }}" 
                                       class="w-full flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit Project
                                    </a>
                                    <a href="{{ route('projects.show', $project) }}" 
                                       target="_blank"
                                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Live
                                    </a>
                                    <button onclick="showDeleteModal({{ $project->id }}, '{{ addslashes($project->title) }}', event)"
                                            class="w-full flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Projects -->
                    @if($relatedProjects && $relatedProjects->count() > 0)
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Related Projects</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($relatedProjects as $related)
                                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                                        @if($related->thumbnail_url)
                                            <img src="{{ $related->thumbnail_url }}" 
                                                 alt="{{ $related->title }}"
                                                 class="w-full h-40 object-cover">
                                        @endif
                                        <div class="p-4">
                                            <h4 class="font-semibold text-gray-900 mb-2">{{ Str::limit($related->title, 40) }}</h4>
                                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($related->short_description, 60) }}</p>
                                            <div class="flex justify-between items-center">
                                                <a href="{{ route('admin.projects.show', $related) }}" 
                                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    View Details
                                                </a>
                                                <span class="text-xs text-gray-500">{{ $related->created_at->format('M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal for Gallery -->
    <div id="imageModal" class="fixed inset-0 z-50 overflow-y-auto hidden bg-black bg-opacity-75">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative max-w-4xl w-full">
                <button onclick="closeImageModal()" 
                        class="absolute -top-10 right-0 text-white hover:text-gray-300 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Gallery Image" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
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

    <script>
        // Image Modal Functions
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.classList.add('modal-open');
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
        
        // Close image modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
                closeImageModal();
            }
        });
        
        // Close image modal on background click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Delete Modal Functions
        function showDeleteModal(projectId, projectTitle, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = "{{ route('admin.projects.destroy', ':id') }}".replace(':id', projectId);
            document.getElementById('projectTitle').textContent = projectTitle;
            
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.classList.add('modal-open');
            
            return false;
        }
        
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
        
        // Close delete modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                hideDeleteModal();
            }
        });
        
        // Close delete modal on background click
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
    </script>

    <style>
        /* Modal styles */
        body.modal-open {
            overflow: hidden;
        }
        
        /* Prose styling for description */
        .prose {
            line-height: 1.6;
        }
        
        .prose p {
            margin-bottom: 1rem;
        }
        
        .prose ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .prose ol {
            list-style-type: decimal;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</x-admin-layout>