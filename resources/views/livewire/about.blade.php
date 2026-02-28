<div class="flex px-4 mx-auto items-center justify-center py-28 font-montser mt-16 md:mt-0">
    <div class="bg-second rounded-lg shadow-md shadow-green-101 w-full px-4 md:px-32 py-4">
        <div class="flex flex-col md:flex-row mx-auto items-center justify-center">
            <div class="flex flex-col w-full md:w-1/2 pb-8">
                <div class="relative mt-8 mb-4 left-10">
                    <h1 class="text-2xl font-bold text-primary max-w-xs gs_reveal"><span class="absolute -left-10 text-xs rotate-[300deg] font-extrabold text-primary mr-4">About me</span>Skills & Project Repository</h1>
                </div>
                <p class="text-xs text-primary text-center md:text-start gs_reveal gs_reveal_fromLeft">Hi! I'm Teguh Dwi Saputra, a passionate developer with a love for creating beautiful and functional web applications. With a strong background in both design and development, I focus on delivering clean and responsive websites that provide an optimal user experience.</p>
                <p class="text-xs text-primary text-center md:text-start gs_reveal gs_reveal_fromLeft">Whether it's crafting efficient back-end logic or designing sleek user interfaces, I aim to bring ideas to life with precision and creativity.</p>
                <h4 class="text-lg font-semibold text-primary mt-4 gs_reveal gs_reveal_fromLeft">Skills</h4>
                <div class="grid grid-cols-4 md:grid-cols-6 gap-2 mx-auto md:mx-0 md:mr-auto gs_reveal">
                    <img src="{{ asset('images/src/Php.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Js.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Jquery.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/SQL.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/GIT.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/GITHUB.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Laravel.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Vue.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Tailwind.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Bootstrap.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Alpine.png') }}" alt="" class="h-16 md:h-12">
                    <img src="{{ asset('images/src/Figma.png') }}" alt="" class="h-16 md:h-12">
                </div>
            </div>
            <div class="flex flex-col w-full md:w-1/2 pb-8 px-4">
                <h4 class="text-lg font-semibold text-primary mt-4 gs_reveal">Project Repository</h4>
                <div class="flex flex-col w-full gap-2 mt-6">
                    @foreach($projects as $project)
                        <a href="{{ route('projects.show', $project->slug) }}" class="relative bg-blue-102 px-4 py-2 rounded-md text-primary transition duration-200 ease-in-out group cursor-pointer hover:-translate-y-2 hover:translate-x-2 hover:shadow-[-4px_8px_8px_0px_#2196f3]">
                            <h5 class="text-base font-semibold gs_reveal gs_reveal_fromRight">{{ $project->title }}</h5>
                            <p class="pl-4 text-xs gs_reveal gs_reveal_fromRight">{{ $project->short_description }}</p>
    
                            <!-- Image on Hover -->
                            {{-- <div class="absolute left-0 md:-left-80 -top-24 md:top-0 w-80 h-auto bg-primary rounded-lg p-2 rounded-lg overflow-hidden opacity-0 group-hover:opacity-80 transition-opacity duration-500 ease-in-out z-[100]">
                                <img src="{{ asset('images/projects/img.png') }}" alt="Movie App Image" class="w-full h-full object-cover">
                            </div> --}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>