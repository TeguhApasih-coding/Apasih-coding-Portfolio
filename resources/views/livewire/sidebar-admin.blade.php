<aside class="sidebar-transition {{ $collapsed ? 'w-20' : 'w-64' }} bg-gradient-to-b from-blue-102 to-second text-primary flex flex-col h-full border-r border-blue-103">
    <!-- Logo Section -->
    <div class="p-4 border-b border-blue-103 flex items-center justify-between">
        @if(!$collapsed)
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <a href="/">
                    <span class="font-bold text-lg">Admin Panel</span>
                </a>
            </div>
        @else
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mx-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
        @endif
        
        <!-- Toggle Button -->
        <button wire:click="toggleSidebar" class="p-2 rounded-lg hover:bg-blue-103 {{ $collapsed ? 'mx-auto' : '' }}">
            @if($collapsed)
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            @else
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            @endif
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto no-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('admin.home') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'dashboard' ? 'bg-blue-103' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            @if(!$collapsed)
                <span>Dashboard</span>
            @endif
        </a>

        <!-- Projects -->
        <a href="{{ route('admin.projects.index') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'projects' ? 'bg-blue-103' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            @if(!$collapsed)
                <span>Projects</span>
            @endif
        </a>

        <!-- Categories -->
        <a href="{{ route('admin.skill-categories.index') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'categories' ? 'bg-blue-103' : '' }} relative">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
            </svg>
            @if(!$collapsed)
                <span>Categories</span>
            @endif
        </a>

        <!-- Skills -->
        <a href="{{ route('admin.skills.index') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'skills' ? 'bg-blue-103' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
            @if(!$collapsed)
                <span>Skills</span>
            @endif
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.contact.message') }}" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'messages' ? 'bg-blue-103' : '' }} relative">
            <!-- Icon selalu muncul, baik sidebar collapsed maupun tidak -->
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            
            <!-- Teks hanya muncul ketika sidebar tidak collapsed -->
            @if(!$collapsed)
                <span>Messages</span>
            @endif
            
            <!-- Notif badge - styling disesuaikan untuk collapsed mode -->
            @if($unreadMessagesCount > 0)
                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full 
                    {{ $collapsed ? 'absolute -top-1 -right-1 min-w-[1.25rem] h-5' : 'ml-auto' }}">
                    {{ $unreadMessagesCount }}
                </span>
            @endif
        </a>
        {{-- <a href="#" 
           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-103 {{ $activeMenu === 'messages' ? 'bg-blue-103' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            @if(!$collapsed)
                <span>Messages</span>
            @endif
            @if($unreadMessagesCount > 0)
                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                    {{ $unreadMessagesCount }}
                </span>
            @endif
        </a> --}}
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-blue-103">
        <div class="flex items-center space-x-3">
            <!-- Avatar -->
            <a href="{{ route('profile.edit') }}">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
            </a>
            
            <!-- User Info (only shown when sidebar is expanded) -->
            @if(!$collapsed)
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            @endif
            
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 rounded-lg hover:bg-blue-103" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>