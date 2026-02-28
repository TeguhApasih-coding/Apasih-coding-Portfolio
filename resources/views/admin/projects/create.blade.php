<x-admin-layout>
    @section('title', 'Create New Project')
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Create New Project</h1>
                        <p class="mt-2 text-sm text-gray-600">Add a new project to your portfolio</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.projects.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Projects
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow-sm rounded-lg">
                <form id="projectForm" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Progress Steps -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button type="button" 
                                    onclick="showStep(1)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm"
                                    :class="activeStep === 1 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                                Basic Information
                            </button>
                            <button type="button" 
                                    onclick="showStep(2)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm"
                                    :class="activeStep === 2 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                                Details
                            </button>
                            <button type="button" 
                                    onclick="showStep(3)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm"
                                    :class="activeStep === 3 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                                Media & Links
                            </button>
                            <button type="button" 
                                    onclick="showStep(4)"
                                    class="step-tab py-4 px-1 border-b-2 font-medium text-sm"
                                    :class="activeStep === 4 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
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
                                           value="{{ old('title') }}"
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
                                               value="{{ old('slug') }}"
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
                                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('short_description') }}</textarea>
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
                                          class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
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
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('full_description') }}</textarea>
                                </div>

                                <div>
                                    <label for="conclusion" class="block text-sm font-medium text-gray-700">Conclusion (Optional)</label>
                                    <textarea name="conclusion" 
                                              id="conclusion" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('conclusion') }}</textarea>
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
                                            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
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
                                        <option value="intermediate" {{ old('complexity', 'intermediate') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="beginner" {{ old('complexity') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="advanced" {{ old('complexity') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        <option value="expert" {{ old('complexity') == 'expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                </div>

                                <!-- Client -->
                                <div>
                                    <label for="client" class="block text-sm font-medium text-gray-700">Client</label>
                                    <input type="text" 
                                           name="client" 
                                           id="client" 
                                           value="{{ old('client') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Client URL -->
                                <div>
                                    <label for="client_url" class="block text-sm font-medium text-gray-700">Client URL</label>
                                    <input type="url" 
                                           name="client_url" 
                                           id="client_url" 
                                           value="{{ old('client_url') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Timeline -->
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" 
                                           name="start_date" 
                                           id="start_date" 
                                           value="{{ old('start_date') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" 
                                           name="end_date" 
                                           id="end_date" 
                                           value="{{ old('end_date') }}"
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
                                               value="{{ old('budget') }}"
                                               step="0.01"
                                               min="0"
                                               class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        <select name="budget_currency"
                                                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            <option value="USD" {{ old('budget_currency', 'USD') == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ old('budget_currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            <option value="GBP" {{ old('budget_currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                            <option value="IDR" {{ old('budget_currency') == 'IDR' ? 'selected' : '' }}>IDR</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Estimated Hours -->
                                <div>
                                    <label for="estimated_hours" class="block text-sm font-medium text-gray-700">Estimated Hours</label>
                                    <input type="number" 
                                           name="estimated_hours" 
                                           id="estimated_hours" 
                                           value="{{ old('estimated_hours') }}"
                                           min="0"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <!-- Technologies -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Technologies Used</label>
                                <div id="technologiesContainer">
                                    @if(old('technologies'))
                                        @foreach(old('technologies') as $tech)
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
                                    @endif
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
                                    @if(old('categories'))
                                        @foreach(old('categories') as $category)
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
                                    @endif
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
                                                   {{ in_array($skill->id, old('skill_ids', [])) ? 'checked' : '' }}
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
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('challenges') }}</textarea>
                                </div>

                                <div>
                                    <label for="solutions" class="block text-sm font-medium text-gray-700">Solutions Implemented</label>
                                    <textarea name="solutions" 
                                              id="solutions" 
                                              rows="4"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('solutions') }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="lessons_learned" class="block text-sm font-medium text-gray-700">Lessons Learned</label>
                                    <textarea name="lessons_learned" 
                                              id="lessons_learned" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('lessons_learned') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Media & Links -->
                        <div id="step3" class="space-y-6 hidden">
                            <!-- Main Image -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Main Project Image</label>
                                <div class="mt-1 flex items-center">
                                    <div id="imagePreview" class="hidden">
                                        <img id="imagePreviewImg" class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                                    </div>
                                    <div class="ml-4">
                                        <input type="file" 
                                               name="image" 
                                               id="image" 
                                               accept="image/*"
                                               onchange="previewImage(this, 'imagePreviewImg')"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="mt-1 text-sm text-gray-500">Recommended size: 1200x630px (max 2MB)</p>
                                        @error('image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Thumbnail -->
                            <div>
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Image (Optional)</label>
                                <div class="mt-1 flex items-center">
                                    <div id="thumbnailPreview" class="hidden">
                                        <img id="thumbnailPreviewImg" class="h-24 w-24 object-cover rounded-lg border border-gray-300">
                                    </div>
                                    <div class="ml-4">
                                        <input type="file" 
                                               name="thumbnail" 
                                               id="thumbnail" 
                                               accept="image/*"
                                               onchange="previewImage(this, 'thumbnailPreviewImg')"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        <p class="mt-1 text-sm text-gray-500">Smaller version for listings (optional)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div>
                                <label for="gallery" class="block text-sm font-medium text-gray-700">Gallery Images</label>
                                <div id="galleryPreview" class="mt-2 grid grid-cols-3 md:grid-cols-6 gap-2">
                                    <!-- Gallery preview will be added here -->
                                </div>
                                <div class="mt-4">
                                    <input type="file" 
                                           name="gallery[]" 
                                           id="gallery" 
                                           accept="image/*"
                                           multiple
                                           onchange="previewGallery(this)"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="mt-1 text-sm text-gray-500">Select multiple images for project gallery</p>
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
                                               value="{{ old('live_url') }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="github_url" class="block text-sm font-medium text-gray-700">GitHub URL</label>
                                        <input type="url" 
                                               name="github_url" 
                                               id="github_url" 
                                               value="{{ old('github_url') }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="demo_url" class="block text-sm font-medium text-gray-700">Demo URL</label>
                                        <input type="url" 
                                               name="demo_url" 
                                               id="demo_url" 
                                               value="{{ old('demo_url') }}"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="documentation_url" class="block text-sm font-medium text-gray-700">Documentation URL</label>
                                        <input type="url" 
                                               name="documentation_url" 
                                               id="documentation_url" 
                                               value="{{ old('documentation_url') }}"
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
                                           value="{{ old('meta_title') }}"
                                           class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters</p>
                                </div>

                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                    <textarea name="meta_description" 
                                              id="meta_description" 
                                              rows="3"
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('meta_description') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                                </div>

                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                                    <input type="text" 
                                           name="meta_keywords" 
                                           id="meta_keywords" 
                                           value="{{ old('meta_keywords') }}"
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
                                               value="{{ old('sort_order', 0) }}"
                                               min="0"
                                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                                    </div>

                                    <div>
                                        <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                                        <input type="date" 
                                               name="published_at" 
                                               id="published_at" 
                                               value="{{ old('published_at', now()->format('Y-m-d')) }}"
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
                                               {{ old('is_published') ? 'checked' : '' }}
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
                                               {{ old('is_featured') ? 'checked' : '' }}
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
                                    <textarea name="team_members" 
                                              id="team_members" 
                                              rows="3"
                                              placeholder='[{"name": "John Doe", "role": "Developer"}, {"name": "Jane Smith", "role": "Designer"}]'
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md font-mono text-sm">{{ old('team_members') }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">Enter as JSON array of objects with name and role</p>
                                </div>

                                <div>
                                    <label for="collaborators" class="block text-sm font-medium text-gray-700">Collaborators (JSON)</label>
                                    <textarea name="collaborators" 
                                              id="collaborators" 
                                              rows="3"
                                              placeholder='[{"name": "Company Name", "url": "https://example.com"}]'
                                              class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md font-mono text-sm">{{ old('collaborators') }}</textarea>
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
                                Create Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Form Wizard
        let currentStep = 1;
        const totalSteps = 4;

        function showStep(step) {
            // Hide all steps
            for (let i = 1; i <= totalSteps; i++) {
                document.getElementById(`step${i}`).classList.add('hidden');
                document.querySelectorAll('.step-tab')[i-1].classList.remove('border-blue-500', 'text-blue-600');
                document.querySelectorAll('.step-tab')[i-1].classList.add('border-transparent', 'text-gray-500');
            }
            
            // Show current step
            document.getElementById(`step${step}`).classList.remove('hidden');
            document.querySelectorAll('.step-tab')[step-1].classList.remove('border-transparent', 'text-gray-500');
            document.querySelectorAll('.step-tab')[step-1].classList.add('border-blue-500', 'text-blue-600');
            
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
            
            if (currentStep === 1) {
                prevBtn.classList.add('invisible');
            } else {
                prevBtn.classList.remove('invisible');
            }
            
            if (currentStep === totalSteps) {
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
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
            
            if (tech && !techExists(tech, 'technologiesContainer')) {
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
            button.parentElement.remove();
        }

        function techExists(tech, containerId) {
            const inputs = document.querySelectorAll(`#${containerId} input[name="technologies[]"]`);
            return Array.from(inputs).some(input => input.value === tech);
        }

        // Categories management
        function addCategory() {
            const input = document.getElementById('categoryInput');
            const category = input.value.trim();
            
            if (category && !techExists(category, 'categoriesContainer')) {
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
            button.parentElement.remove();
        }

        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = preview.parentElement;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Gallery preview
        function previewGallery(input) {
            const container = document.getElementById('galleryPreview');
            container.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="h-24 w-full object-cover rounded-lg border border-gray-300">
                            <button type="button" onclick="removeGalleryImage(this)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                ×
                            </button>
                            <input type="hidden" name="gallery[]" data-index="${index}">
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        function removeGalleryImage(button) {
            button.parentElement.remove();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
            
            // Enter key for adding technologies/categories
            document.getElementById('techInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addTech();
                }
            });
            
            document.getElementById('categoryInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addCategory();
                }
            });
        });

        // Form validation before submit
        document.getElementById('projectForm').addEventListener('submit', function(e) {
            // Basic validation
            const title = document.getElementById('title').value.trim();
            const slug = document.getElementById('slug').value.trim();
            const shortDescription = document.getElementById('short_description').value.trim();
            const description = document.getElementById('description').value.trim();
            const status = document.getElementById('status').value;
            
            if (!title || !slug || !shortDescription || !description || !status) {
                e.preventDefault();
                alert('Please fill in all required fields (*)');
                showStep(1); // Go back to first step
                return false;
            }
            
            return true;
        });
    </script>
</x-admin-layout>