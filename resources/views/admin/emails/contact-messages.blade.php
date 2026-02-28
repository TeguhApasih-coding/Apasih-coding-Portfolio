<x-admin-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header dengan Statistik -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Contact Messages</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage and respond to your contact form submissions</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Messages -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Messages</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Unread Messages -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Unread Messages</p>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">{{ $stats['unread'] }}</p>
                            @if($stats['unread'] > 0)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 dark:text-yellow-200 dark:bg-yellow-900/30 rounded-full mt-2">
                                    New: {{ $stats['unread'] }} need attention
                                </span>
                            @endif
                        </div>
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Spam Messages -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Spam Messages</p>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2">{{ $stats['spam'] }}</p>
                        </div>
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Today's Messages -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Today's Messages</p>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $stats['today'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Bar -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <!-- Bulk Actions Dropdown -->
                    <select id="bulk-action" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Bulk Actions</option>
                        <option value="mark_read">Mark as Read</option>
                        <option value="mark_spam">Mark as Spam</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button onclick="bulkAction()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Apply
                    </button>
                </div>

                <!-- Filter Tabs -->
                <div class="flex space-x-2 bg-gray-100 dark:bg-gray-800 p-1 rounded-lg">
                    <button onclick="filterMessages('all')" class="filter-btn active px-4 py-2 text-sm font-medium rounded-md transition-all" data-filter="all">
                        All
                    </button>
                    <button onclick="filterMessages('unread')" class="filter-btn px-4 py-2 text-sm font-medium rounded-md transition-all" data-filter="unread">
                        Unread
                        @if($stats['unread'] > 0)
                            <span class="ml-1 px-2 py-0.5 text-xs bg-yellow-200 text-yellow-800 rounded-full">{{ $stats['unread'] }}</span>
                        @endif
                    </button>
                    <button onclick="filterMessages('spam')" class="filter-btn px-4 py-2 text-sm font-medium rounded-md transition-all" data-filter="spam">
                        Spam
                    </button>
                </div>
            </div>

            <!-- Messages Table -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subject</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Message</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($messages as $message)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors message-row" 
                                data-status="{{ $message->is_spam ? 'spam' : ($message->is_read ? 'read' : 'unread') }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="message-checkbox rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $message->id }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {!! $message->status_badge !!}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $message->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $message->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $message->subject ?: 'No Subject' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate">
                                        {{ $message->excerpt }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $message->formatted_date }}</div>
                                    <div class="text-xs text-gray-400 dark:text-gray-500">{{ $message->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.contact.message.show', $message) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        
                                        @if(!$message->is_read)
                                        <button onclick="markAsRead({{ $message->id }})" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Mark as Read">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5"></path>
                                            </svg>
                                        </button>
                                        @endif
                                        
                                        @if(!$message->is_spam)
                                        <button onclick="markAsSpam({{ $message->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Mark as Spam">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </button>
                                        @endif
                                        
                                        <form action="{{ route('admin.contact.message.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <p class="text-lg font-medium">No messages found</p>
                                        <p class="text-sm mt-1">Messages from your contact form will appear here</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($messages->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $messages->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for Interactions -->
    <script>
        // Filter messages
        function filterMessages(filter) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'dark:bg-gray-900', 'shadow-sm', 'text-gray-900', 'dark:text-white');
                btn.classList.add('text-gray-600', 'dark:text-gray-400');
            });
            
            const activeBtn = document.querySelector(`.filter-btn[data-filter="${filter}"]`);
            activeBtn.classList.remove('text-gray-600', 'dark:text-gray-400');
            activeBtn.classList.add('active', 'bg-white', 'dark:bg-gray-900', 'shadow-sm', 'text-gray-900', 'dark:text-white');

            // Filter rows
            document.querySelectorAll('.message-row').forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else if (filter === 'unread') {
                    row.style.display = row.dataset.status === 'unread' ? '' : 'none';
                } else if (filter === 'spam') {
                    row.style.display = row.dataset.status === 'spam' ? '' : 'none';
                }
            });
        }

        // Select all checkboxes
        document.getElementById('select-all').addEventListener('change', function(e) {
            document.querySelectorAll('.message-checkbox').forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });

        // Bulk actions
        function bulkAction() {
            const action = document.getElementById('bulk-action').value;
            if (!action) {
                alert('Please select an action');
                return;
            }

            const selectedIds = Array.from(document.querySelectorAll('.message-checkbox:checked')).map(cb => cb.value);
            if (selectedIds.length === 0) {
                alert('Please select at least one message');
                return;
            }

            if (!confirm(`Are you sure you want to ${action.replace('_', ' ')} ${selectedIds.length} message(s)?`)) {
                return;
            }

            fetch('{{ route("admin.contact.bulk-action") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    action: action,
                    ids: selectedIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred');
            });
        }

        // Mark as read
        function markAsRead(id) {
            fetch(`{{ url('admin/contact-messages') }}/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }

        // Mark as spam
        function markAsSpam(id) {
            if (!confirm('Mark this message as spam?')) return;
            
            fetch(`{{ url('admin/contact-messages') }}/${id}/spam`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    </script>

    <style>
        .filter-btn.active {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            color: #111827;
        }
        .dark .filter-btn.active {
            background-color: #1f2937;
            color: white;
        }
    </style>
</x-admin-layout>