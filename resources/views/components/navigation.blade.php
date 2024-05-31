@props([
    'pages' => \App\Models\Page::root()->orderBy('_lft')->get(),
    'isRoot' => true
])

<div {{ $attributes->merge(['class' => 'fixed top-0 left-0 w-full h-16 bg-white z-10 border-b']) }}>
    <div class="flex justify-between max-w-screen-lg mx-auto gap-16 p-4">
        <!-- Logo on the left -->
        <div class="flex-shrink-0 font-bold">
            {{ $logo }}
        </div>

        <!-- Navigation menu on the right -->
        <div class="items-center hidden md:flex gap-x-4">
            {{ $prepend ?? '' }}
            @foreach($pages as $page)
                <div class="relative">
                    <a class="text-gray-700 transition duration-300 ease-in-out hover:text-blue-600"
                       href="{{ $page->getUrl() }}">{{ $page->title }}</a>
                    {{-- Uncomment and update this block if you need a dropdown for child pages
                    @if ($page->isActive() or $page->isChildActive())
                        <div class="absolute top-8 w-96">
                            <x-navigation :pages="$page->activeChildren()->get()" :is-root="false"/>
                        </div>
                    @endif --}}
                </div>
            @endforeach
            {{ $append ?? '' }}
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="block md:hidden">
            <button id="mobile-menu-button" class="focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-b">
        <div class="flex flex-col items-start p-4 gap-y-2">
            {{ $prepend ?? '' }}
            @foreach($pages as $page)
                <a class="text-gray-700 transition duration-300 ease-in-out hover:text-blue-600"
                   href="{{ $page->getUrl() }}">{{ $page->title }}</a>
            @endforeach
            {{ $append ?? '' }}
        </div>
    </div>
</div>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
