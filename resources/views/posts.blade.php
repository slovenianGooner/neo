@use('Illuminate\Support\Facades\Lang')

<x-layout :page-title="Lang::get('neo.posts_title', locale: $locale)">
    <div class="bg-white py-24 max-w-7xl mx-auto">
        <div class="px-6 lg:px-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ Lang::get('neo.posts_title', locale: $locale) }}</h2>
            </div>
            <div class="mx-auto mt-16 grid max-w-none grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:grid-cols-3">
                @forelse($posts as $post)
                    <article class="flex flex-col items-start justify-between">
                        @if ($post->hasMedia('thumbnail'))
                            <a class="relative w-full block" href="{{ $post->getUrlWithQueryString() }}">
                                <img
                                    src="{{ $post->getFirstMediaUrl('thumbnail') }}"
                                    alt=""
                                    class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                            </a>
                        @endif
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="text-gray-500">
                                    {{ $post->created_at->format('F j, Y') }}
                                </time>
                            </div>
                            <div class="group relative">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="{{ $post->getUrlWithQueryString() }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                    {{ $post->getExcerpt(200) }}...
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="leading-8 text-gray-600 col-span-full">
                        {{ __('No posts found.') }}
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
