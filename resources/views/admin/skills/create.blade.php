<x-admin-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with back button -->
            <div class="flex items-center mb-6">
                <a href="{{ route('admin.skills.index') }}" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 transition-colors duration-200 mr-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Create New Skill</h2>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <form action="{{ route('admin.skills.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Skill Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200 @error('name') border-red-500 @enderror"
                               placeholder="e.g., Laravel, React, Photoshop">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category and Level -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category
                            </label>
                            <select name="category_id" id="category_id"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200">
                                <option value="">Select Category</option>
                                @foreach($categories as $id => $name)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                <a href="{{ route('admin.skill-categories.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Create new category</a>
                            </p>
                        </div>

                        <!-- Level -->
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Proficiency Level <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <input type="range" name="level" id="level" min="0" max="100" value="{{ old('level', 50) }}" 
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                                       oninput="document.getElementById('levelValue').textContent = this.value + '%'">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">Beginner</span>
                                    <span class="text-indigo-600 dark:text-indigo-400 font-medium" id="levelValue">{{ old('level', 50) }}%</span>
                                    <span class="text-gray-600 dark:text-gray-400">Expert</span>
                                </div>
                            </div>
                            @error('level')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Icon and Color -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Icon (SVG or Path)
                            </label>
                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200"
                                   placeholder="<svg>...</svg> or /storage/icons/skill.svg">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Paste SVG code or path to icon image
                            </p>
                        </div>

                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Color
                            </label>
                            <div class="flex gap-3">
                                <input type="color" name="color" id="color" value="{{ old('color', '#6366f1') }}"
                                       class="h-10 w-20 rounded border border-gray-300 dark:border-gray-600 cursor-pointer">
                                <input type="text" name="color_hex" id="color_hex" value="{{ old('color', '#6366f1') }}"
                                       class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200"
                                       placeholder="#6366f1"
                                       oninput="document.getElementById('color').value = this.value">
                            </div>
                            @error('color')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="display_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Display Order
                        </label>
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $maxOrder) }}" min="0"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Lower numbers appear first
                        </p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-colors duration-200"
                                  placeholder="Brief description of your skill...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Toggle Switches -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Is Featured -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div>
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Featured Skill</label>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Show this skill in featured section</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" class="sr-only peer" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- Is Active -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div>
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Active Status</label>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Make this skill visible</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" class="sr-only peer" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.skills.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Create Skill
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Sync color picker and text input
        document.getElementById('color').addEventListener('input', function(e) {
            document.getElementById('color_hex').value = e.target.value;
        });

        // Preview skill icon
        document.getElementById('icon').addEventListener('input', function(e) {
            // You can add live preview functionality here
        });
    </script>
    @endpush
</x-admin-layout>