<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Panel - @yield('title')</title>

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
        <style>
            /* Smooth transitions */
            .sidebar-transition {
                transition: all 0.3s ease-in-out;
            }
            
            /* Hide scrollbar but keep functionality */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    </head>
    <body class="font-montser antialiased bg-primary min-h-screen">
        <div class="flex h-screen bg-primary dark:bg-second">
            <livewire:sidebar-admin />

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                <div class="p-4">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-red-700">{{ session('error') }}</span>
                        </div>
                    @endif
                    
                    {{ $slot }}
                </div>
            </main>
        </div>

        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <!-- AlpineJS -->
        <script src="//unpkg.com/alpinejs" defer></script>

        {{-- <!-- Modal Form Contact -->
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
        </script> --}}
    </body>
</html>
