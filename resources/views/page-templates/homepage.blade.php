<x-layout>
    <div class="relative bg-white">
        <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <div class="hidden sm:mt-32 sm:flex lg:mt-16">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            {{ $page->template_data['top_link_text'] }}
                            <a href="{{ $page->template_data['top_link_url'] }}"
                               class="whitespace-nowrap font-semibold text-indigo-600">
                                {{ $page->template_data['top_link_read_more_text'] }} <span
                                    aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                    <h1 class="mt-24 text-4xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">
                        {{ $page->template_data['hero_title'] }}
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        {{ $page->template_data['hero_text'] }}
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ $page->template_data['hero_cta_url'] }}"
                           class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            {{ $page->template_data['hero_cta_text'] }}
                        </a>
                        <a href="{{ $page->template_data['hero_secondary_cta_url'] }}"
                           class="text-sm font-semibold leading-6 text-gray-900">
                            {{ $page->template_data['hero_secondary_cta_text'] }} <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
                <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
                     src="{{ $page->getFirstMediaUrl('hero_image') }}"
                     alt="">
            </div>
        </div>
    </div>
    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-400">
                    {{ $page->template_data['features_subtitle'] }}
                </h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    {{ $page->template_data['features_title'] }}
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    {{ $page->template_data['features_text'] }}
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    @foreach($page->template_data['features'] as $feature)
                        <div class="flex flex-col">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                {{ $feature['title'] }}
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                                <p class="flex-auto">
                                    {{ $feature['text'] }}
                                </p>
                                <p class="mt-6">
                                    <a href="{{ $feature['url'] }}"
                                       class="text-sm font-semibold leading-6 text-indigo-400">
                                        {{ $feature['link_text'] }} <span aria-hidden="true">→</span>
                                    </a>
                                </p>
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {!! nl2br($page->template_data['cta_title']) !!}
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">
                    {{ $page->template_data['cta_text'] }}
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ $page->template_data['primary_cta_url'] }}"
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ $page->template_data['primary_cta_text'] }}
                    </a>
                    <a href="{{ $page->template_data['secondary_cta_url'] }}"
                       class="text-sm font-semibold leading-6 text-gray-900">
                        {{ $page->template_data['secondary_cta_text'] }}<span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
