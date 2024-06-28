<x-layout :page-title="$page->title">
    <x-plugins.glightbox>
        <script type="text/javascript">
            const lightbox = GLightbox({
                selector: '.glightbox-img-content img'
            });
        </script>
    </x-plugins.glightbox>
    <div class="bg-white px-6 py-24 lg:px-8 max-w-screen-xl mx-auto">
        <div class="text-base leading-7 text-gray-700">
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $page->title }}</h1>
            <div class="prose glightbox-img-content max-w-none mt-6 [&>p>img]:cursor-pointer">
                {!! tiptap_converter()->asHTML($page->body) !!}
            </div>
            @foreach($page->posts as $post)
                @php app()->bind('modelInstance', fn() => $post->load('media')) @endphp
                <div class="mt-10">
                    <h2 class="mt-16 text-2xl font-bold tracking-tight text-gray-900">{{ $post->title }}</h2>
                    <div class="prose glightbox-img-content max-w-none mt-6 [&>p>img]:cursor-pointer">
                        {!! tiptap_converter()->asHTML($post->body) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
