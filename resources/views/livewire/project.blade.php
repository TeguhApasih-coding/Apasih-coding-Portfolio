<div class="flex flex-col w-full mx-auto items-center justify-center font-montser py-8 px-4">
    <h1 class="text-second text-2xl font-bold gs_reveal">Recent <span class="text-red-101 gs_reveal gs_reveal_fromRight">Project.</span></h1>
    <div class="grid grid-cols-1 md:grid-cols-3 mx-auto items-center justify-center gap-4 mt-4 skewElem">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}">
            <img src="{{ $project->image_url }}" alt="" class="w-96 h-[230px] rounded-md border border-second py-2">

        </a>
        @endforeach
        {{-- <img src="{{ asset('images/projects/img.png') }}" alt="" class="w-96 rounded-md border border-second py-2">
        <img src="{{ asset('images/projects/img.png') }}" alt="" class="w-96 rounded-md border border-second py-2">
        <img src="{{ asset('images/projects/img.png') }}" alt="" class="w-96 rounded-md border border-second py-2">
        <img src="{{ asset('images/projects/img.png') }}" alt="" class="w-96 rounded-md border border-second py-2">
        <img src="{{ asset('images/projects/img.png') }}" alt="" class="w-96 rounded-md border border-second py-2"> --}}
    </div>
</div>