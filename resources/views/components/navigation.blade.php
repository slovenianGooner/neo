@use('Illuminate\Support\Facades\Lang')

@props([
    'pages' => \App\Models\Page::getForNavigation($locale),
    'isRoot' => true
])

@pushonce('js', 'alpinejs')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpushonce

<header class="bg-white w-full fixed top-0 left-0 z-10" x-data="{ open: false }">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex items-center gap-x-12"><a href="{{ local_route('home') }}" class="-m-1.5 p-1.5">
                <span class="sr-only">{{ config("app.name") }}</span>
                <span class="font-bold text-lg">[{{ config("app.name") }}]</span>
            </a>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="{{ local_route('home') }}"
                   class="text-sm font-semibold leading-6 {{ local_route_is('home') ? 'text-indigo-600' : 'text-gray-900' }}">
                    {{ word('neo.homepage_title') }}
                </a>
                <a href="{{ local_route('posts') }}"
                   class="text-sm font-semibold leading-6 {{ local_route_is('posts') ? 'text-indigo-600' : 'text-gray-900' }}">
                    {{ word('neo.posts_title') }}
                </a>
                @foreach($pages as $page)
                    <a href="{{ $page->getUrl() }}"
                       class="text-sm font-semibold leading-6 {{ $page->isActive() ? 'text-indigo-600' : 'text-gray-900' }}">{{ $page->title }}</a>
                @endforeach
            </div>
        </div>
        <div class="flex lg:hidden">
            <button x-on:click="open = true" type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>
        @if ($hasMultipleLocales)
            <div class="hidden lg:flex space-x-4">
                @foreach(config('neo.locales') as $key => $label)
                    <a href="{{ route('home.' . $key) }}"
                       class="text-sm font-semibold leading-6 text-gray-900 uppercase px-1.5 rounded {{ $locale === $key ? 'bg-gray-900 text-white' : '' }}">
                        {{ $key }}
                    </a>
                @endforeach
            </div>
        @endif
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true" x-show="open" x-cloak>
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div
            class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="{{ local_route('home') }}" class="-m-1.5 p-1.5">
                    <span class="sr-only">{{ config('app.name') }}</span>
                    <span class="font-bold text-lg">[{{ config("app.name") }}]</span>
                </a>
                <button x-on:click="open = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="space-y-2 py-6">
                    <a href="{{ local_route('home') }}"
                       class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 {{ local_route_is('home') ? 'text-indigo-600' : 'text-gray-900' }} hover:bg-gray-50">
                        {{ word('neo.homepage_title') }}
                    </a>
                    <a href="{{ local_route('posts') }}"
                       class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 {{ local_route_is('posts') ? 'text-indigo-600' : 'text-gray-900' }} hover:bg-gray-50">
                        {{ word('neo.posts_title') }}
                    </a>
                    @foreach($pages as $page)
                        <a href="{{ $page->getUrl() }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 {{ $page->isActive() ? 'text-indigo-600' : 'text-gray-900' }} hover:bg-gray-50">{{ $page->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
