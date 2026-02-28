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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-primary">
        <div class="min-h-screen bg-primary dark:bg-gray-900">
            <livewire:navigation />

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
