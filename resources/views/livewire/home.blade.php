<div class="flex flex-col md:flex-row mx-auto px-8 md:px-16 max-w-4xl font-montser">
    <div class="flex flex-col items-start justify-center w-full md:w-1/2 h-full md:h-96 pt-32 md:pt-0">
        <div id="profile" class="border-2 border-second rounded-full hover:animate-bounce cursor-pointer">
            <img src="{{ asset('images/src/profile.png') }}" alt="Profile" class="w-16 h-16 object-cover rounded-full object-center">
        </div>
        <div class="relative mt-8 left-10">
            <h1 class="text-4xl font-extrabold text-second max-w-xs"><span class="absolute -left-8 text-sm rotate-[300deg] font-extrabold text-second mr-4">Hello!</span>I’m Teguh Dwi Saputra</h1>
        </div>
    </div>
    <div class="flex flex-col items-start justify-center w-full md:w-1/2 h-full md:h-96 text-second gap-2 mt-8 md:mt-0">
        <h3 class="dis-1 font-bold text-2xl"></h3>
        <p class="text-sm dis-2"></p>
        <div class="btn flex gap-2 mt-4">
            {{-- <a href="" class="bg-second border border-second text-primary px-4 py-2 font-semibold rounded-lg text-xs hover:animate-focus-in">Talk with me</a> --}}
            <button onclick="openModal()" class="relative bg-second border border-second text-primary px-4 py-2 font-semibold rounded-lg text-xs duration-500 z-[1] overflow-hidden before:content-[''] before:block before:w-0 before:h-0 before:-translate-x-2/4 before:-translate-y-2/4 before:absolute before:-z-[1] before:bg-primary before:duration-500 before:ease-in-out after:content-[''] after:block after:w-0 after:h-0 after:-translate-x-2/4 after:-translate-y-2/4 after:absolute after:-z-[1] after:bg-primary after:duration-500 after:ease-in-out before:-top-4 before:-left-4 after:top-full after:left-full hover:before:h-32 hover:before:w-32 hover:after:h-32 hover:after:w-32 hover:text-second">Talk with me</button>
            <a href="#project" class="relative bg-transparent border border-second text-second px-4 py-2 font-semibold rounded-lg text-xs duration-500 z-[1] overflow-hidden before:content-[''] before:block before:w-0 before:h-0 before:-translate-x-2/4 before:-translate-y-2/4 before:absolute before:-z-[1] before:bg-red-101 before:duration-500 before:ease-in-out after:content-[''] after:block after:w-0 after:h-0 after:-translate-x-2/4 after:-translate-y-2/4 after:absolute after:-z-[1] after:bg-red-101 after:duration-500 after:ease-in-out before:-top-4 before:-left-4 after:top-full after:left-full hover:before:h-32 hover:before:w-32 hover:after:h-32 hover:after:w-32 hover:text-primary">See my work</a>
        </div>
    </div>
</div>