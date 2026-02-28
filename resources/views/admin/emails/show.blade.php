<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.contact.message') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Messages
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Message -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                                {{ substr($message->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $message->name }}</h2>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $message->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    {!! $message->status_badge !!}
                                </div>
                            </div>
                        </div>

                        <!-- Message Content -->
                        <div class="px-6 py-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Subject</h3>
                                <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                    {{ $message->subject ?: 'No Subject' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Message</h3>
                                <div class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg whitespace-pre-wrap">
                                    {{ $message->message }}
                                </div>
                            </div>

                            <!-- Meta Info -->
                            <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Received:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white font-medium">{{ $message->formatted_date }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Time ago:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white font-medium">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">IP Address:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white font-medium">{{ $message->ip_address }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">User Agent:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white font-medium text-xs">{{ $message->user_agent }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if(!$message->is_spam)
                                        <form action="{{ route('admin.contact.mark-spam', $message) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                                Mark as Spam
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.contact.message.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                @if($message->is_spam)
                                <form action="{{ route('admin.contact.mark-spam', $message) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mark as Not Spam
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Similar Messages -->
                    @if($similarMessages->count() > 0)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <h3 class="font-medium text-gray-900 dark:text-white">Messages from same IP</h3>
                        </div>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($similarMessages as $similar)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <a href="{{ route('admin.contact.message.show', $similar) }}" class="block">
                                    <div class="flex items-start justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $similar->name }}</span>
                                        {!! $similar->status_badge !!}
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $similar->subject ?: 'No Subject' }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">{{ $similar->excerpt }}</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">{{ $similar->created_at->diffForHumans() }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <h3 class="font-medium text-gray-900 dark:text-white">Quick Info</h3>
                        </div>
                        <div class="p-4">
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Total messages from this user:</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $similarMessages->count() + 1 }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">First contact:</span>
                                    <span class="text-sm text-gray-900 dark:text-white">{{ $message->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="pt-2 border-t border-gray-200 dark:border-gray-700">
                                    <button onclick="window.location.href='mailto:{{ $message->email }}'" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        Reply via Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>