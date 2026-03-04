<nav id="nav" x-data="{ open: false }" class="sticky top-0 md:relative mx-auto bg-gradient-to-b from-second to-blue-102 border border-second w-full max-w-none h-full py-3 mt-0 md:mt-3 z-[50]">
    <div id="nav-items" class="flex mx-auto px-4 md:px-8 justify-between md:justify-center transition duration-300 ease-in-out">
        {{-- Logo  --}}
        <div class="flex items-center md:hidden">
            <a href="/" class="text-xl text-primary font-extrabold font-montser">Teguh.</a>
        </div>
        {{-- Navigation --}}
        <div class="flex">
            <div id="link" class="hidden md:flex space-x-4 text-primary font-montser text-center items-center justify-center">
                <a href="{{ route('home') }}" class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Home</a>
                <a href="{{ route('projects.index') }}" class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Projects</a>

                {{-- @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->is_admin)
                            <a href="{{route('admin.home')}}" class="flex items-center justify-center text-lg font-extrabold font-montser px-2 overflow-hidden"><span class="box-border bg-inherit relative duration-100 hover:tracking-widest before:box-border before:bg-inherit before:absolute before:content-[''] hover:text-primary/70 focus:text-primary/70 hover:before:animate-chitchat focus:before:animate-chitchat">Teguh.</span></a>                            
                        @else
                            <a href="{{route('dashboard')}}" class="flex items-center justify-center text-lg font-extrabold font-montser px-2 overflow-hidden"><span class="box-border bg-inherit relative duration-100 hover:tracking-widest before:box-border before:bg-inherit before:absolute before:content-[''] hover:text-primary/70 focus:text-primary/70 hover:before:animate-chitchat focus:before:animate-chitchat">Teguh.</span></a>                       
                        @endif
                    @else
                        <a href="#nav" class="flex items-center justify-center text-lg font-extrabold font-montser px-2 overflow-hidden"><span class="box-border bg-inherit relative duration-100 hover:tracking-widest before:box-border before:bg-inherit before:absolute before:content-[''] hover:text-primary/70 focus:text-primary/70 hover:before:animate-chitchat focus:before:animate-chitchat">Teguh.</span></a>                       
                    @endauth
                @endif --}}

                {{-- <a href="#project" class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Project</a> --}}
                <button onclick="openModal()" class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Contact</button>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Log Out</a>

                    {{-- <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="text-xs font-semibold hover:text-green-101 before:ml-auto after:content[''] after:w-0 after:h-0.5 after:bg-blue-101 after:block after:duration-300 before:content[''] before:w-0 before:h-0.5 before:bg-blue-101 before:block before:duration-300 hover:after:w-full hover:before:w-full hover:text-primary">Log Out</span>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link> --}}
                </form>
            </div>
        </div>
        <!-- Hamburger -->
        <div class="-me-2 flex items-center md:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-primary hover:text-primary hover:bg-blue-102 focus:outline-none focus:bg-blue-102 focus:text-primary transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>


    {{-- Responsive Navigation Menu --}}
    <div x-cloak :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out text-primary hover:text-second hover:bg-primary focus:outline-none focus:text-second focus:bg-primary">
                Home
            </a>
            <a href="{{ route('projects.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out text-primary hover:text-second hover:bg-primary focus:outline-none focus:text-second focus:bg-primary">
                Project
            </a>
            <button onclick="openModal()" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out text-primary hover:text-second hover:bg-primary focus:outline-none focus:text-second focus:bg-primary">Contact</button>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out text-primary hover:text-second hover:bg-primary focus:outline-none focus:text-second focus:bg-primary">Log Out</a>
            </form>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
            @else
            <div class="px-4">
                <div class="font-medium text-base text-white-101">{{Auth::user()->name}} </div>
                <div class="font-medium text-sm text-gray-500">{{Auth::user()->email}} </div>
            </div>

            <div class="mt-3 space-y-1">
            @if(Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.home')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @else
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endguest
        </div>
    </div> --}}
</nav>
