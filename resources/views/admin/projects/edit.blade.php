<x-admin-layout>
    @section('title', 'Edit Project: ' . $project->title)
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Project</h1>
                        <p class="mt-2 text-sm text-gray-600">{{ $project->title }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.projects.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Projects
                        </a>
                        <a href="{{ route('projects.show', $project) }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow-sm rounded-lg">
                <form id="projectForm" action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Progress Steps -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button type="button" 
                                    onclick="showStep(1)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600">
                                Basic Information
                            </button>
                            <button type="button" 
                                    onclick="showStep(2)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Details
                            </button>
                            <button type="button" 
                                    onclick="showStep(3)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Media & Links
                            </button>
                            <button type="button" 
                                    onclick="showStep(4)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                SEO & Settings
                            </button>
                        </nav>
                    </div>

                    <div class="p-6">
                        <!-- Step 1: Basic Information -->
                        <div id="step1" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Project Title *</label>
                                    <input type="text" 
                                           name="title" 
                                           id="title" 
                                           value="{{ old('title', $project->title) }}"
                                           required
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" 
                                               name="slug" 
                                               id="slug" 
                                               value="{{ old('slug', $project->slug) }}"
                                               required
                                               class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300">
                                        <button type="button" 
                                                onclick="generateSlug()"
                                                class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 text-sm hover:bg-gray-100">
                                            Generate
                                        </button>
                                    </div>
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div>
                                <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description *</label>
                                <textarea name="short_description" 
                                          id="short_description" 
                                          rows="3"
                                          required
                                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('short_description', $project->short_description) }}</textarea>
                                <p class="mt-2 text-sm text-gray-500">Brief description for project cards and listings (max 500 characters)</p>
                                @error('short_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Full Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Full Description *</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="6"
                                          required
                                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Additional Description Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="full_description" class="block text-sm font-medium text-gray-700">Detailed Description (Optional)</label>
                                    <textarea name="full_description" 
                                              id="full_description" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('full_description', $project->full_description) }}</textarea>
                                </div>

                                <div>
                                    <label for="conclusion" class="block text-sm font-medium text-gray-700">Conclusion (Optional)</label>
                                    <textarea name="conclusion" 
                                              id="conclusion" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('conclusion', $project->conclusion) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Details -->
                        <div id="step2" class="space-y-6 hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <select name="status" 
                                            id="status"
                                            required
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Select Status</option>
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ old('status', $project->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Complexity -->
                                <div>
                                    <label for="complexity" class="block text-sm font-medium text-gray-700">Complexity</label>
                                    <select name="complexity" 
                                            id="complexity"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="intermediate" {{ old('complexity', $project->complexity) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="beginner" {{ old('complexity', $project->complexity) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="advanced" {{ old('complexity', $project->complexity) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        <option value="expert" {{ old('complexity', $project->complexity) == 'expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                </div>

                                <!-- Client -->
                                <div>
                                    <label for="client" class="block text-sm font-medium text-gray-700">Client</label>
                                    <input type="text" 
                                           name="client" 
                                           id="client" 
                                           value="{{ old('client', $project->client) }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Client URL -->
                                <div>
                                    <label for="client_url" class="block text-sm font-medium text-gray-700">Client URL</label>
                                    <input type="url" 
                                           name="client_url" 
                                           id="client_url" 
                                           value="{{ old('client_url', $project->client_url) }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Timeline -->
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" 
                                           name="start_date" 
                                           id="start_date" 
                                           value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" 
                                           name="end_date" 
                                           id="end_date" 
                                           value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Budget -->
                                <div>
                                    <label for="budget" class="block text-sm font-medium text-gray-700">Budget</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            $
                                        </span>
                                        <input type="number" 
                                               name="budget" 
                                               id="budget" 
                                               value="{{ old('budget', $project->budget) }}"
                                               step="0.01"
                                               min="0"
                                               class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        <select name="budget_currency"
                                                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            <option value="USD" {{ old('budget_currency', $project->budget_currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ old('budget_currency', $project->budget_currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            <option value="GBP" {{ old('budget_currency', $project->budget_currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                                            <option value="IDR" {{ old('budget_currency', $project->budget_currency) == 'IDR' ? 'selected' : '' }}>IDR</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Estimated Hours -->
                                <div>
                                    <label for="estimated_hours" class="block text-sm font-medium text-gray-700">Estimated Hours</label>
                                    <input type="number" 
                                           name="estimated_hours" 
                                           id="estimated_hours" 
                                           value="{{ old('estimated_hours', $project->estimated_hours) }}"
                                           min="0"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <!-- Technologies -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Technologies Used</label>
                                <div id="technologiesContainer">
                                    @php
                                        $technologies = old('technologies', $project->technologies ?? []);
                                        if (is_string($technologies)) {
                                            $technologies = json_decode($technologies, true) ?? [];
                                        }
                                    @endphp
                                    @foreach($technologies as $tech)
                                        @if($tech)
                                            <div class="tech-item inline-flex items-center mr-2 mb-2 px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                                <span>{{ $tech }}</span>
                                                <button type="button" onclick="removeTech(this)" class="ml-2 text-blue-600 hover:text-blue-800">
                                                    ×
                                                </button>
                                                <input type="hidden" name="technologies[]" value="{{ $tech }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-2 flex">
                                    <input type="text" 
                                           id="techInput" 
                                           placeholder="Add technology (e.g., Laravel, React)"
                                           class="flex-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <button type="button" 
                                            onclick="addTech()"
                                            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Add
                                    </button>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Press Enter or click Add to include technologies</p>
                            </div>

                            <!-- Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                                <div id="categoriesContainer">
                                    @php
                                        $categories = old('categories', $project->categories ?? []);
                                        if (is_string($categories)) {
                                            $categories = json_decode($categories, true) ?? [];
                                        }
                                    @endphp
                                    @foreach($categories as $category)
                                        @if($category)
                                            <div class="category-item inline-flex items-center mr-2 mb-2 px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                                <span>{{ $category }}</span>
                                                <button type="button" onclick="removeCategory(this)" class="ml-2 text-green-600 hover:text-green-800">
                                                    ×
                                                </button>
                                                <input type="hidden" name="categories[]" value="{{ $category }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-2 flex">
                                    <input type="text" 
                                           id="categoryInput" 
                                           placeholder="Add category (e.g., Web Development, Mobile)"
                                           class="flex-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <button type="button" 
                                            onclick="addCategory()"
                                            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Add
                                    </button>
                                </div>
                            </div>

                            <!-- Skills -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Related Skills</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach($skills as $skill)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" 
                                                   name="skill_ids[]" 
                                                   value="{{ $skill->id }}"
                                                   {{ in_array($skill->id, old('skill_ids', $project->skills->pluck('id')->toArray())) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $skill->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Challenges & Solutions -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="challenges" class="block text-sm font-medium text-gray-700">Challenges Faced</label>
                                    <textarea name="challenges" 
                                              id="challenges" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('challenges', $project->challenges) }}</textarea>
                                </div>

                                <div>
                                    <label for="solutions" class="block text-sm font-medium text-gray-700">Solutions Implemented</label>
                                    <textarea name="solutions" 
                                              id="solutions" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('solutions', $project->solutions) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="lessons_learned" class="block text-sm font-medium text-gray-700">Lessons Learned</label>
                                    <textarea name="lessons_learned" 
                                              id="lessons_learned" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('lessons_learned', $project->lessons_learned) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Media & Links -->
                        <div id="step3" class="space-y-6 hidden">
                            <!-- Current Images -->
                            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Current Images</h4>
                                
                                <!-- Main Image -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Main Image:</p>
                                    @if($project->image)
                                        <div class="flex items-center">
                                            <img src="{{ $project->image_url }}" 
                                                 alt="Current main image" 
                                                 class="h-24 w-24 object-cover rounded-lg border border-gray-300">
                                            <div class="ml-4">
                                                <a href="{{ $project->image_url }}" 
                                                   target="_blank"
                                                   class="text-sm text-blue-600 hover:text-blue-800">
                                                    View Full Size
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">No main image set</p>
                                    @endif
                                </div>

                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Thumbnail:</p>
                                    @if($project->thumbnail)
                                        <div class="flex items-center">
                                            <img src="{{ $project->thumbnail_url }}" 
                                                 alt="Current thumbnail" 
                                                 class="h-20 w-20 object-cover rounded-lg border border-gray-300">
                                            <div class="ml-4">
                                                <a href="{{ $project->thumbnail_url }}" 
                                                   target="_blank"
                                                   class="text-sm text-blue-600 hover:text-blue-800">
                                                    View Full Size
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Using main image as thumbnail</p>
                                    @endif
                                </div>

                                <!-- Gallery -->
                                @if($project->gallery && count($project->gallery) > 0)
                                    <div>
                                        <p class="text-sm text-gray-600 mb-2">Gallery Images ({{ count($project->gallery) }}):</p>
                                        <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                                            @foreach($project->gallery_urls as $imageUrl)
                                                <img src="{{ $imageUrl }}" 
                                                     alt="Gallery image"
                                                     class="h-20 w-full object-cover rounded-lg border border-gray-300">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Update Images -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Update Images</h4>
                                
                                <!-- Main Image -->
                                <div class="mb-6">
                                    <label for="image" class="block text-sm font-medium text-gray-700">Update Main Project Image</label>
                                    <div class="mt-1 flex items-center">
                                        <div id="imagePreview" class="{{ $project->image ? '' : 'hidden' }}">
                                            <img id="imagePreviewImg" 
                                                 src="{{ $project->image_url }}" 
                                                 class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                                        </div>
                                        <div class="ml-4">
                                            <input type="file" 
                                                   name="image" 
                                                   id="image" 
                                                   accept="image/*"
                                                   onchange="previewImage(this, 'imagePreviewImg')"
                                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            <p class="mt-1 text-sm text-gray-500">Leave empty to keep current image</p>
                                            @error('image')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Thumbnail -->
                                <div class="mb-6">
                                    <label for="thumbnail" class="block text-sm font-medium text-gray-700">Update Thumbnail Image</label>
                                    <div class="mt-1 flex items-center">
                                        <div id="thumbnailPreview" class="{{ $project->thumbnail ? '' : 'hidden' }}">
                                            <img id="thumbnailPreviewImg" 
                                                 src="{{ $project->thumbnail_url }}" 
                                                 class="h-24 w-24 object-cover rounded-lg border border-gray-300">
                                        </div>
                                        <div class="ml-4">
                                            <input type="file" 
                                                   name="thumbnail" 
                                                   id="thumbnail" 
                                                   accept="image/*"
                                                   onchange="previewImage(this, 'thumbnailPreviewImg')"
                                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            <p class="mt-1 text-sm text-gray-500">Leave empty to keep current thumbnail</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Gallery -->
                                <div class="mb-6">
                                    <label for="gallery" class="block text-sm font-medium text-gray-700">Add Gallery Images</label>
                                    <div id="galleryPreview" class="mt-2 grid grid-cols-3 md:grid-cols-6 gap-2">
                                        <!-- New gallery preview will be added here -->
                                    </div>
                                    <div class="mt-4">
                                        <input type="file" 
                                               name="gallery[]" 
                                               id="gallery" 
                                               accept="image/*"
                                               multiple
                                               onchange="previewGallery(this)"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="mt-1 text-sm text-gray-500">Select new images to add to gallery (existing images will be kept)</p>
                                    </div>
                                    @if($project->gallery && count($project->gallery) > 0)
                                        <div class="mt-3">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" 
                                                       name="clear_gallery" 
                                                       value="1"
                                                       class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                                                <span class="ml-2 text-sm text-red-600">Remove all existing gallery images</span>
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Project Links -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Project Links</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="live_url" class="block text-sm font-medium text-gray-700">Live URL</label>
                                        <input type="url" 
                                               name="live_url" 
                                               id="live_url" 
                                               value="{{ old('live_url', $project->live_url) }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="github_url" class="block text-sm font-medium text-gray-700">GitHub URL</label>
                                        <input type="url" 
                                               name="github_url" 
                                               id="github_url" 
                                               value="{{ old('github_url', $project->github_url) }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="demo_url" class="block text-sm font-medium text-gray-700">Demo URL</label>
                                        <input type="url" 
                                               name="demo_url" 
                                               id="demo_url" 
                                               value="{{ old('demo_url', $project->demo_url) }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="documentation_url" class="block text-sm font-medium text-gray-700">Documentation URL</label>
                                        <input type="url" 
                                               name="documentation_url" 
                                               id="documentation_url" 
                                               value="{{ old('documentation_url', $project->documentation_url) }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: SEO & Settings -->
                        <div id="step4" class="space-y-6 hidden">
                            <!-- SEO Settings -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">SEO Settings</h3>
                                
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                    <input type="text" 
                                           name="meta_title" 
                                           id="meta_title" 
                                           value="{{ old('meta_title', $project->meta_title) }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters</p>
                                </div>

                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                    <textarea name="meta_description" 
                                              id="meta_description" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('meta_description', $project->meta_description) }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                                </div>

                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                                    @php
                                        $keywords = old('meta_keywords', $project->meta_keywords);
                                        if (is_array($keywords)) {
                                            $keywords = implode(', ', $keywords);
                                        } elseif (is_string($keywords)) {
                                            $keywords = json_decode($keywords, true);
                                            if (is_array($keywords)) {
                                                $keywords = implode(', ', $keywords);
                                            }
                                        }
                                    @endphp
                                    <input type="text" 
                                           name="meta_keywords" 
                                           id="meta_keywords" 
                                           value="{{ $keywords }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <p class="mt-1 text-sm text-gray-500">Separate with commas (e.g., web development, laravel, portfolio)</p>
                                </div>
                            </div>

                            <!-- Project Settings -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Project Settings</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                        <input type="number" 
                                               name="sort_order" 
                                               id="sort_order" 
                                               value="{{ old('sort_order', $project->sort_order) }}"
                                               min="0"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                                    </div>

                                    <div>
                                        <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                                        <input type="date" 
                                               name="published_at" 
                                               id="published_at" 
                                               value="{{ old('published_at', $project->published_at ? $project->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <!-- Toggles -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_published" 
                                               id="is_published" 
                                               value="1"
                                               {{ old('is_published', $project->is_published) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="is_published" class="ml-2 block text-sm text-gray-900">
                                            Publish Project
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="is_featured" 
                                               id="is_featured" 
                                               value="1"
                                               {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                            Feature Project
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Team & Collaboration -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Team & Collaboration</h3>
                                
                                <div>
                                    <label for="team_members" class="block text-sm font-medium text-gray-700">Team Members (JSON)</label>
                                    @php
                                        $teamMembers = old('team_members', $project->team_members);
                                        if (is_array($teamMembers)) {
                                            $teamMembers = json_encode($teamMembers, JSON_PRETTY_PRINT);
                                        }
                                    @endphp
                                    <textarea name="team_members" 
                                              id="team_members" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md font-mono text-sm">{{ $teamMembers }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Enter as JSON array of objects with name and role</p>
                                </div>

                                <div>
                                    <label for="collaborators" class="block text-sm font-medium text-gray-700">Collaborators (JSON)</label>
                                    @php
                                        $collaborators = old('collaborators', $project->collaborators);
                                        if (is_array($collaborators)) {
                                            $collaborators = json_encode($collaborators, JSON_PRETTY_PRINT);
                                        }
                                    @endphp
                                    <textarea name="collaborators" 
                                              id="collaborators" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md font-mono text-sm">{{ $collaborators }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between pt-6 border-t border-gray-200">
                            <button type="button" 
                                    onclick="previousStep()"
                                    id="prevBtn"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Previous
                            </button>
                            
                            <button type="button" 
                                    onclick="nextStep()"
                                    id="nextBtn"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Next
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            
                            <button type="submit" 
                                    id="submitBtn"
                                    class="hidden inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Project
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Delete Form -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-medium text-red-700">Danger Zone</h4>
                            <p class="text-sm text-red-600">Once you delete a project, there is no going back.</p>
                        </div>
                        <button type="button" 
                                onclick="showDeleteModal({{ $project->id }}, '{{ addslashes($project->title) }}')"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Project
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the same JavaScript functions from create.blade.php -->
    <script>
        // Form Wizard
        let currentStep = 1;
        const totalSteps = 4;
    
        function showStep(step) {
            // Hide all steps
            for (let i = 1; i <= totalSteps; i++) {
                const stepElement = document.getElementById(`step${i}`);
                const tabElement = document.querySelectorAll('.step-tab')[i-1];
                
                if (stepElement) {
                    stepElement.classList.add('hidden');
                }
                
                if (tabElement) {
                    tabElement.classList.remove('border-blue-500', 'text-blue-600');
                    tabElement.classList.add('border-transparent', 'text-gray-500');
                }
            }
            
            // Show current step
            const currentStepElement = document.getElementById(`step${step}`);
            if (currentStepElement) {
                currentStepElement.classList.remove('hidden');
            }
            
            const currentTab = document.querySelectorAll('.step-tab')[step-1];
            if (currentTab) {
                currentTab.classList.remove('border-transparent', 'text-gray-500');
                currentTab.classList.add('border-blue-500', 'text-blue-600');
            }
            
            currentStep = step;
            updateButtons();
        }
    
        function nextStep() {
            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        }
    
        function previousStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }
    
        function updateButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            
            if (prevBtn) {
                if (currentStep === 1) {
                    prevBtn.classList.add('invisible');
                } else {
                    prevBtn.classList.remove('invisible');
                }
            }
            
            if (nextBtn && submitBtn) {
                if (currentStep === totalSteps) {
                    nextBtn.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                } else {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');
                }
            }
        }
    
        // Generate slug from title
        function generateSlug() {
            const title = document.getElementById('title').value;
            if (title) {
                const slug = title.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
                document.getElementById('slug').value = slug;
            }
        }
    
        // Technologies management
        function addTech() {
            const input = document.getElementById('techInput');
            const tech = input.value.trim();
            
            if (tech) {
                const container = document.getElementById('technologiesContainer');
                const div = document.createElement('div');
                div.className = 'tech-item inline-flex items-center mr-2 mb-2 px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800';
                div.innerHTML = `
                    <span>${tech}</span>
                    <button type="button" onclick="removeTech(this)" class="ml-2 text-blue-600 hover:text-blue-800">
                        ×
                    </button>
                    <input type="hidden" name="technologies[]" value="${tech}">
                `;
                container.appendChild(div);
                input.value = '';
            }
        }
    
        function removeTech(button) {
            button.closest('.tech-item').remove();
        }
    
        // Categories management
        function addCategory() {
            const input = document.getElementById('categoryInput');
            const category = input.value.trim();
            
            if (category) {
                const container = document.getElementById('categoriesContainer');
                const div = document.createElement('div');
                div.className = 'category-item inline-flex items-center mr-2 mb-2 px-3 py-1 rounded-full text-sm bg-green-100 text-green-800';
                div.innerHTML = `
                    <span>${category}</span>
                    <button type="button" onclick="removeCategory(this)" class="ml-2 text-green-600 hover:text-green-800">
                        ×
                    </button>
                    <input type="hidden" name="categories[]" value="${category}">
                `;
                container.appendChild(div);
                input.value = '';
            }
        }
    
        function removeCategory(button) {
            button.closest('.category-item').remove();
        }
    
        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (!preview) return;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    const container = preview.closest('[id$="Preview"]');
                    if (container) {
                        container.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    
        // Gallery preview
        function previewGallery(input) {
            const container = document.getElementById('galleryPreview');
            if (!container) return;
            
            container.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-20 w-full object-cover rounded-lg border border-gray-300';
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    
        // Form submission handler
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize first step
            showStep(1);
            
            // Auto-generate slug on title input
            const titleInput = document.getElementById('title');
            if (titleInput) {
                titleInput.addEventListener('input', function() {
                    const slugInput = document.getElementById('slug');
                    if (slugInput && !slugInput.value.trim()) {
                        generateSlug();
                    }
                });
            }
            
            // Enter key handlers
            const techInput = document.getElementById('techInput');
            if (techInput) {
                techInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        addTech();
                    }
                });
            }
            
            const categoryInput = document.getElementById('categoryInput');
            if (categoryInput) {
                categoryInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        addCategory();
                    }
                });
            }
            
            // Form submit handler
            const form = document.getElementById('projectForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitted'); // Debug log
                    
                    // Validate required fields
                    const title = document.getElementById('title')?.value.trim();
                    const slug = document.getElementById('slug')?.value.trim();
                    const shortDescription = document.getElementById('short_description')?.value.trim();
                    const description = document.getElementById('description')?.value.trim();
                    const status = document.getElementById('status')?.value;
                    
                    if (!title || !slug || !shortDescription || !description || !status) {
                        e.preventDefault();
                        alert('Please fill in all required fields (*)');
                        
                        if (!title || !slug || !shortDescription || !description) {
                            showStep(1);
                        } else if (!status) {
                            showStep(2);
                        }
                        return false;
                    }
                    
                    return true;
                });
            }
        });
    
        // Delete modal
        function showDeleteModal(projectId, projectTitle) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 overflow-y-auto';
            modal.innerHTML = `
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.698-.833-2.464 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Project</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete the project <strong>"${projectTitle}"</strong>?
                                            This action cannot be undone.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <form method="POST" action="/admin/projects/${projectId}" class="inline">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Delete
                                </button>
                            </form>
                            <button type="button" onclick="this.closest('.fixed').remove()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
    </script>
</x-admin-layout>