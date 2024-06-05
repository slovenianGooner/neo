<x-layout :page-title="$page->title">
    <x-plugins.glightbox>
        <script type="text/javascript">
            const lightbox = GLightbox({
                selector: '.glightbox-img-content img'
            });
        </script>
    </x-plugins.glightbox>
    <div class="bg-white px-6 py-32 lg:px-8 max-w-4xl mx-auto">
        <div class="text-base leading-7 text-gray-700">
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $page->title }}</h1>
            <div
                class="prose glightbox-img-content max-w-none mt-6 [&>p>img]:max-w-3xl [&>p>img]:mx-auto [&>p>img]:cursor-pointer">
                {!! $page->body !!}
            </div>
            @foreach($page->posts as $post)
                <div class="mt-10">
                    <h2 class="mt-16 text-2xl font-bold tracking-tight text-gray-900">{{ $post->title }}</h2>
                    <div
                        class="prose glightbox-img-content max-w-none mt-6 [&>p>img]:max-w-3xl [&>p>img]:mx-auto [&>p>img]:cursor-pointer">
                        {!! $post->body !!}
                    </div>
                </div>
            @endforeach
        </div>

        @if (isset($page->template_data['offices']))
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3 not-prose mt-10">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                    @foreach($page->template_data['offices'] as $office)
                        <div class="rounded-2xl bg-gray-50 p-10">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $office['name'] }}</h3>
                            <dl class="mt-3 space-y-1 text-sm leading-6 text-gray-600">
                                <div>
                                    <dt class="sr-only">{{ word('neo.email') }}</dt>
                                    <dd><a class="font-semibold text-indigo-600"
                                           href="mailto:{{ $office['email'] }}">{{ $office['email'] }}</a>
                                    </dd>
                                </div>
                                <div class="mt-1">
                                    <dt class="sr-only">{{ word('neo.address') }}</dt>
                                    <dd>{{ $office['address'] }}</dd>
                                </div>
                            </dl>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="max-w-2xl mt-10">
            <livewire:contact-us-form :locale="$locale"/>
        </div>
    </div>
</x-layout>
