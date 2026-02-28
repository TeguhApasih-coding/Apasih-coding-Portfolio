<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Montserrat -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-primary">
        <div class="min-h-screen bg-primary dark:bg-gray-900">
            <livewire:nav />

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- Modal Form Contact -->
            <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity duration-300 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4 py-4 lg:py-8">
                    <!-- Modal Content -->
                    <div class="bg-primary rounded-2xl shadow-2xl w-full max-w-4xl xl:max-w-5xl mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-none lg:max-h-[90vh] overflow-hidden flex flex-col"
                        id="modalContent">
                        
                        <!-- Close Button -->
                        <div class="flex justify-end p-3 lg:p-4 shrink-0">
                            <button onclick="closeModal()" 
                                    class="text-green-103 hover:text-second transition-colors duration-200 p-1">
                                <svg class="w-6 h-6 lg:w-7 lg:h-7" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.96965 8.96967C9.26254 8.67678 9.73742 8.67678 10.0303 8.96967L12 10.9394L13.9696 8.96969C14.2625 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0303L13.0606 12L15.0303 13.9697C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73744 15.3232 9.26256 15.3232 8.96967 15.0303C8.67678 14.7374 8.67678 14.2626 8.96967 13.9697L10.9393 12L8.96965 10.0303C8.67676 9.73744 8.67676 9.26256 8.96965 8.96967Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Main Content - Flex Horizontal -->
                        <div class="flex flex-col lg:flex-row overflow-hidden flex-1 min-h-full lg:min-h-0">
                            <!-- Form Contact (Kiri) -->
                            <div class="w-full lg:w-1/2 bg-gradient-to-br from-blue-50 to-purple-50 p-4 lg:p-6 xl:p-8 overflow-y-auto">
                                <h2 class="text-xl lg:text-2xl xl:text-3xl font-bold text-second mb-2 text-center">Get In Touch</h2>
                                <p class="text-green-103 text-sm lg:text-base mb-4 lg:mb-6 xl:mb-8 text-center">Fill out the form and I'll get back to you soon</p>
                                
                                <form id="contactForm" class="space-y-3 lg:space-y-4 xl:space-y-6">
                                    @csrf
                                    
                                    <!-- Success/Error Messages -->
                                    <div id="formMessage" class="hidden px-3 lg:px-4 py-2 lg:py-3 rounded-lg text-xs lg:text-sm xl:text-base"></div>

                                    <!-- Nama & Email Row -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-4 xl:gap-6">
                                        <!-- Nama -->
                                        <div>
                                            <label for="modal_name" class="block text-xs lg:text-sm font-medium text-green-102 mb-1 lg:mb-2">
                                                Nama Lengkap *
                                            </label>
                                            <input type="text" id="modal_name" name="name" required
                                                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-green-105 rounded-lg focus:ring-2 focus:ring-blue-101 focus:border-transparent transition-all duration-300 hover:border-green-104 text-xs lg:text-sm xl:text-base bg-white/5 text-green-103 placeholder-green-104"
                                                placeholder="Masukkan nama Anda">
                                        </div>
                                        
                                        <!-- Email -->
                                        <div>
                                            <label for="modal_email" class="block text-xs lg:text-sm font-medium text-green-102 mb-1 lg:mb-2">
                                                Email *
                                            </label>
                                            <input type="email" id="modal_email" name="email" required
                                                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-green-105 rounded-lg focus:ring-2 focus:ring-blue-101 focus:border-transparent transition-all duration-300 hover:border-green-104 text-xs lg:text-sm xl:text-base bg-white/5 text-green-103 placeholder-green-104"
                                                placeholder="email@contoh.com">
                                        </div>
                                    </div>
                                    
                                    <!-- Subject -->
                                    <div>
                                        <label for="modal_subject" class="block text-xs lg:text-sm font-medium text-green-102 mb-1 lg:mb-2">
                                            Subjek
                                        </label>
                                        <input type="text" id="modal_subject" name="subject"
                                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-green-105 rounded-lg focus:ring-2 focus:ring-blue-101 focus:border-transparent transition-all duration-300 hover:border-green-104 text-xs lg:text-sm xl:text-base bg-white/5 text-green-103 placeholder-green-104"
                                            placeholder="Subjek pesan Anda">
                                    </div>
                                    
                                    <!-- Message -->
                                    <div>
                                        <label for="modal_message" class="block text-xs lg:text-sm font-medium text-green-102 mb-1 lg:mb-2">
                                            Pesan *
                                        </label>
                                        <textarea id="modal_message" name="message" rows="3" required
                                            class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-green-105 rounded-lg focus:ring-2 focus:ring-blue-101 focus:border-transparent transition-all duration-300 hover:border-green-104 resize-vertical text-xs lg:text-sm xl:text-base bg-white/5 text-green-103 placeholder-green-104 min-h-[80px] lg:min-h-[100px]"
                                            placeholder="Tulis pesan Anda..."></textarea>
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    {{-- <button type="submit" class="group relative w-full bg-gradient-to-r from-blue-102 to-second hover:from-blue-102/90 hover:to-second/90 text-white py-2 lg:py-3 xl:py-4 px-4 lg:px-6 rounded-lg font-semibold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl active:translate-y-0 active:scale-95 text-xs lg:text-sm xl:text-base mt-3 lg:mt-4 focus:outline-none focus:ring-2 focus:ring-blue-102/50 focus:ring-offset-2 focus:ring-offset-primary overflow-hidden">
                                    
                                        <!-- Ripple Effect Background -->
                                        <span class="absolute inset-0 bg-white/20 transform scale-0 group-hover:scale-100 transition-transform duration-500 opacity-0 group-hover:opacity-100"></span>
                                        
                                        <!-- Content -->
                                        <div class="flex items-center justify-center relative z-10">
                                            <!-- SVG Icon -->
                                            <div class="mr-2 lg:mr-3 transition-all duration-300 group-hover:translate-x-1 group-hover:scale-110">
                                                <svg class="w-4 h-4 lg:w-5 lg:h-5 xl:w-6 xl:h-6" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 14.016l9.216 6.912 18.784-16.928-14.592 20.064 10.592 7.936 8-32zM8 32l6.016-4-6.016-4v8z"/>
                                                </svg>
                                            </div>
                                            
                                            <!-- Text -->
                                            <span class="transition-all duration-300 group-hover:tracking-wide">
                                                Kirim Pesan
                                            </span>
                                        </div>
                                    </button> --}}

                                    <button type="submit" 
                                            id="submitButton"
                                            class="group relative w-full bg-gradient-to-r from-blue-102 to-second hover:from-blue-102/90 hover:to-second/90 text-white py-3 lg:py-4 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl active:translate-y-0 active:scale-95 text-sm lg:text-base mt-4 focus:outline-none focus:ring-4 focus:ring-blue-102/30 focus:ring-offset-2 overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed">
                                        
                                        <!-- Content -->
                                        <div class="flex items-center justify-center relative z-10">
                                            <!-- Default Icon -->
                                            <div id="submitIcon" class="mr-3 transition-all duration-300 group-hover:translate-x-1 group-hover:scale-110">
                                                <svg class="w-5 h-5 lg:w-6 lg:h-6" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 14.016l9.216 6.912 18.784-16.928-14.592 20.064 10.592 7.936 8-32zM8 32l6.016-4-6.016-4v8z"/>
                                                </svg>
                                            </div>
                                            
                                            <!-- Loading Spinner (hidden by default) -->
                                            <div id="loadingSpinner" class="hidden mr-3">
                                                <svg class="w-5 h-5 lg:w-6 lg:h-6 animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </div>
                                            
                                            <!-- Text -->
                                            <span id="submitText" class="transition-all duration-300 group-hover:tracking-wide">
                                                Kirim Pesan
                                            </span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Foto & Info Kontak (Kanan) -->
                            <div class="w-full lg:w-1/2 bg-gradient-to-br from-blue-50 to-purple-50 p-4 lg:p-6 xl:p-8 rounded-b-2xl lg:rounded-r-2xl lg:rounded-bl-none flex flex-col items-center justify-center overflow-y-auto min-h-[300px] lg:min-h-[400px] xl:min-h-auto">
                                
                                <!-- Foto dengan ukuran responsive -->
                                <div class="mb-3 lg:mb-4 xl:mb-6 relative flex-shrink-0">
                                    <div class="w-16 h-16 lg:w-20 lg:h-20 xl:w-24 xl:h-24 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 border-3 lg:border-4 border-white shadow-2xl animate-bounce hover:animate-pulse transition-all duration-500 hover:scale-105 hover:shadow-xl overflow-hidden">
                                        <!-- Fallback SVG -->
                                        <div class="w-full h-full flex items-center justify-center text-white">
                                            <svg class="w-6 h-6 lg:w-8 lg:h-8 xl:w-10 xl:h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="8" r="3" stroke="currentColor" stroke-width="2"/>
                                                <path d="M5 20V19C5 15.134 8.13401 12 12 12C15.866 12 19 15.134 19 19V20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Info Kontak -->
                                <div class="text-center space-y-2 lg:space-y-3 xl:space-y-4 w-full px-1 lg:px-2">
                                    <h3 class="text-xl lg:text-2xl font-bold text-second">Teguh Dwi Saputra</h3>
                                    <p class="text-green-103 text-base lg:text-lg">Full Stack Developer</p>
                                    
                                    <!-- Contact Info dengan SVG Icons -->
                                    <div class="space-y-1 lg:space-y-2 xl:space-y-3 text-sm text-green-103 w-full">
                                        <!-- Email -->
                                        <div class="flex items-center justify-center">
                                            <div class="w-3 h-3 lg:w-4 lg:h-4 mr-1 lg:mr-2 flex-shrink-0 text-blue-500">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm break-all">teguhdwis.tds@gmail.com</span>
                                        </div>
                                        
                                        <!-- Phone -->
                                        <div class="flex items-center justify-center">
                                            <div class="w-3 h-3 lg:w-4 lg:h-4 mr-1 lg:mr-2 flex-shrink-0 text-green-500">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM12 3v10l3-3h6V3h-9z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm">+62 812 8845 0678</span>
                                        </div>
                                        
                                        <!-- Location -->
                                        <div class="flex items-center justify-center">
                                            <div class="w-3 h-3 lg:w-4 lg:h-4 mr-1 lg:mr-2 flex-shrink-0 text-red-500">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm">Jakarta, Indonesia</span>
                                        </div>
                                    </div>

                                    <!-- Social Links dengan SVG -->
                                    <div class="flex justify-center space-x-2 lg:space-x-3 xl:space-x-4 pt-2 lg:pt-3 xl:pt-4">
                                        <!-- WhatsApp Link dengan Dynamic Data -->
                                        @php
                                            $phoneNumber = '6281288450678'; // Ganti dengan nomor Anda
                                            $defaultMessage = 'Halo, saya tertarik untuk berkolaborasi dengan Anda';
                                            $encodedMessage = urlencode($defaultMessage);
                                            $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
                                        @endphp
                                        <!-- WhatsApp -->
                                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 lg:w-12 lg:h-12 bg-primary rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 group">
                                            <div class="w-4 h-4 lg:w-6 lg:h-6 text-green-500 group-hover:text-green-600">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.75 13.96c.25.13.41.2.46.3.06.11.04.61-.21 1.18-.2.56-1.24 1.1-1.7 1.12-.46.02-.47.36-2.96-.73-2.49-1.09-3.99-3.75-4.11-3.92-.12-.17-.96-1.38-.92-2.61.05-1.22.69-1.8.95-2.04.24-.26.51-.29.68-.26h.47c.15 0 .36-.06.55.45l.69 1.87c.06.13.1.28.01.44l-.27.41-.39.42c-.12.12-.26.25-.12.5.12.26.62 1.09 1.32 1.78.91.88 1.71 1.17 1.95 1.3.24.14.39.12.54-.04l.81-.94c.19-.25.35-.19.58-.11l1.67.88M12 2a10 10 0 0 1 10 10 10 10 0 0 1-10 10c-1.97 0-3.8-.57-5.35-1.55L2 22l1.55-4.65A9.969 9.969 0 0 1 2 12 10 10 0 0 1 12 2m0 2a8 8 0 0 0-8 8c0 1.72.54 3.31 1.46 4.61L4.5 19.5l2.89-.96A7.95 7.95 0 0 0 12 20a8 8 0 0 0 8-8 8 8 0 0 0-8-8z"/>
                                                </svg>
                                            </div>
                                        </a>
                                        
                                        <!-- LinkedIn -->
                                        <a href="https://www.linkedin.com/in/teguh-dwi-saputra-36b13a18b" target="_blank" rel="noopener noreferrer" class="w-10 h-10 lg:w-12 lg:h-12 bg-primary rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 group">
                                            <div class="w-4 h-4 lg:w-6 lg:h-6 text-blue-600 group-hover:text-blue-700">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </div>
                                        </a>
                                        
                                        <!-- GitHub -->
                                        <a href="https://github.com/Apasih-coding?tab=repositories" target="_blank" rel="noopener noreferrer" class="w-10 h-10 lg:w-12 lg:h-12 bg-primary rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 hover:scale-110 group">
                                            <div class="w-4 h-4 lg:w-6 lg:h-6 text-gray-800 group-hover:text-black">
                                                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <livewire:footer />
        </footer>

        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

        <script>
            // Detect if a link's href goes to the current page
            function getSamePageAnchor (link) {
            if (
                link.protocol !== window.location.protocol ||
                link.host !== window.location.host ||
                link.pathname !== window.location.pathname ||
                link.search !== window.location.search
            ) {
                return false;
            }

            return link.hash;
            }

            // Scroll to a given hash, preventing the event given if there is one
            function scrollToHash(hash, e) {
            const elem = hash ? document.querySelector(hash) : false;
            if(elem) {
                if(e) e.preventDefault();
                gsap.to(window, {duration: 3,scrollTo: elem});
            }
            }

            // If a link's href is within the current page, scroll to it instead
            document.querySelectorAll('a[href]').forEach(a => {
            a.addEventListener('click', e => {
                scrollToHash(getSamePageAnchor(a), e);
            });
            });

            // Scroll to the element in the URL's hash on load
            scrollToHash(window.location.hash);
        </script>

        <!-- GSAP basic from -->
        <script>
            gsap.registerPlugin(TextPlugin);
            gsap.from('#link', {duration: 2.5, x: 0, y: 200, opacity: 0, ease: 'power4.in'});
            gsap.from('#home h1', {duration: 1.5, delay:1, opacity: 0, y:100, ease: 'power4.Out'});
            gsap.from('#profile', {duration: 2, delay:0, x: -200, opacity: 0, ease: 'back'});
            gsap.from('#home .btn', {duration: 2, delay:4, x: 200, opacity: 0, ease: 'back'});
            gsap.to('#home .dis-1', {duration:2, delay:1.5, text: 'A Web Developer based in Jakarta, Indonesia'});
            gsap.to('#home .dis-2', {duration:3.5, delay: 3, text: 'passionate creating great experiences for the best websites'});
        </script>

        <!-- GSAP plugin demo -->
        <script>
            function animateFrom(elem, direction) {
                direction = direction || 1;
                var x = 0,
                    y = direction * 200;
                if(elem.classList.contains("gs_reveal_fromLeft")) {
                    x = -100;
                    y = 0;
                } else if (elem.classList.contains("gs_reveal_fromRight")) {
                    x = 100;
                    y = 0;
                }
                elem.style.transform = "translate(" + x + "px, " + y + "px)";
                elem.style.opacity = "0";
                gsap.fromTo(elem, {x: x, y: y, autoAlpha: 0}, {
                    duration: 2.25, 
                    x: 0,
                    y: 0, 
                    autoAlpha: 1, 
                    ease: "expo", 
                    overwrite: "auto"
                });
                }

                function hide(elem) {
                gsap.set(elem, {autoAlpha: 0});
                }

                document.addEventListener("DOMContentLoaded", function() {
                gsap.registerPlugin(ScrollTrigger);
                
                gsap.utils.toArray(".gs_reveal").forEach(function(elem) {
                    hide(elem); // assure that the element is hidden when scrolled into view
                    
                    ScrollTrigger.create({
                    trigger: elem,
                    markers: false,
                    onEnter: function() { animateFrom(elem) }, 
                    onEnterBack: function() { animateFrom(elem, -1) },
                    onLeave: function() { hide(elem) } // assure that the element is hidden when scrolled into view
                    });
                });
                });
        </script>

        <!-- // Skew on scroll using scroll velocity - ScrollTrigger - Demo -->
        <script>
            let proxy = { skew: 0 },
                skewSetter = gsap.quickSetter(".skewElem", "skewY", "deg"), // fast
                clamp = gsap.utils.clamp(-20, 20); // don't let the skew go beyond 20 degrees. 

            ScrollTrigger.create({
            onUpdate: (self) => {
                let skew = clamp(self.getVelocity() / -300);
                // only do something if the skew is MORE severe. Remember, we're always tweening back to 0, so if the user slows their scrolling quickly, it's more natural to just let the tween handle that smoothly rather than jumping to the smaller skew.
                if (Math.abs(skew) > Math.abs(proxy.skew)) {
                proxy.skew = skew;
                gsap.to(proxy, {skew: 0, duration: 0.8, ease: "power3", overwrite: true, onUpdate: () => skewSetter(proxy.skew)});
                }
            }
            });

            // make the right edge "stick" to the scroll bar. force3D: true improves performance
            gsap.set(".skewElem", {transformOrigin: "right center", force3D: true});

        </script>

        <!-- Modal Form Contact -->
        <script>
            // Variabel untuk modal dan form
            const modal = document.getElementById('contactModal');
            const modalContent = document.getElementById('modalContent');
            const contactForm = document.getElementById('contactForm');
            const formMessage = document.getElementById('formMessage');
            const submitButton = document.getElementById('submitButton');
            const submitIcon = document.getElementById('submitIcon');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const submitText = document.getElementById('submitText');

            // Fungsi untuk menampilkan pesan
            function showMessage(message, type) {
                formMessage.textContent = message;
                formMessage.classList.remove('hidden');
                
                // Reset classes
                formMessage.className = 'px-4 py-3 rounded-lg text-sm';
                
                // Add type-specific classes
                if (type === 'success') {
                    formMessage.classList.add('bg-green-100', 'border', 'border-green-400', 'text-green-700');
                } else {
                    formMessage.classList.add('bg-red-100', 'border', 'border-red-400', 'text-red-700');
                }
                
                // Auto hide after 5 seconds
                setTimeout(() => {
                    formMessage.classList.add('hidden');
                }, 5000);
            }

            // Fungsi untuk reset form state
            function resetFormState() {
                submitButton.disabled = false;
                submitIcon.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
                submitText.textContent = 'Kirim Pesan';
            }

            // Handle form submission
            contactForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Disable button dan show loading
                submitButton.disabled = true;
                submitIcon.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                submitText.textContent = 'Mengirim...';
                
                try {
                    // const formData = new FormData(this);

                    // ✅ METHOD 2: Atau gunakan manual object
                    const formData = {
                        name: document.getElementById('modal_name').value,
                        email: document.getElementById('modal_email').value,
                        subject: document.getElementById('modal_subject').value,
                        message: document.getElementById('modal_message').value,
                        _token: '{{ csrf_token() }}'
                    };
                    console.log('Sending formData:', formData); // Debug log
                    
                    const response = await fetch('{{ route("contact.send") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(formData)
                    });
                    console.log('Response status:', response.status);

                    const responseData = await response.json();
                    console.log('Response data:', responseData);
                    
                    if (responseData.success) {
                        showMessage(responseData.message, 'success');
                        this.reset(); // Reset form
                        
                        // Auto close modal setelah 3 detik
                        setTimeout(() => {
                            closeModal();
                        }, 3000);
                    } else {
                        showMessage(responseData.message, 'error');
                    }
                    
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('❌ Terjadi error jaringan, silakan coba lagi.', 'error');
                } finally {
                    resetFormState();
                }
            });

            // Fungsi untuk membuka modal
            function openModal() {
                modal.classList.remove('hidden');
                // Trigger animation setelah modal ditampilkan
                setTimeout(() => {
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
                
                // Prevent body scroll ketika modal terbuka
                document.body.style.overflow = 'hidden';
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                modal.classList.remove('opacity-100');
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                
                // Tunggu animasi selesai sebelum hide modal
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                    resetForm();
                }, 300);
            }

            // Reset form dan pesan
            function resetForm() {
                contactForm.reset();
                formMessage.classList.add('hidden');
                formMessage.classList.remove('bg-green-100', 'border-green-400', 'text-green-700', 
                                        'bg-red-100', 'border-red-400', 'text-red-700');
            }

            // Close modal ketika klik di luar konten
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Close modal dengan ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        </script>

        {{-- <script>
            window.onscroll = function() {
                let navbar = document.getElementById("nav");
                let navItems = document.getElementById("nav-items");
                let navIcons = document.getElementById("nav-icons");
                // Ketika halaman di-scroll lebih dari 100px
                if (document.documentElement.scrollTop > 85) {
                    navbar.classList.remove("w-full", "bg-second", "border");
                    navbar.classList.add("right-2", "h-full", "fixed");
                    navItems.classList.remove("flex");
                    navItems.classList.add("hidden");
                    navIcons.classList.remove("hidden");
                    navIcons.classList.add('flex', 'absolute', 'right-1', 'z-10');
                } else {
                    navbar.classList.remove("right-2", "h-full", "fixed");
                    navbar.classList.add("w-full", "flex", "bg-second", "border");
                    navItems.classList.remove("hidden");
                    navItems.classList.add("flex");
                    navIcons.classList.add("hidden");
                }
            };
        </script> --}}
    </body>
</html>
