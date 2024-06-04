<x-layout :page-title="$post->title">
    <x-plugins.glightbox>
        <script type="text/javascript">
            const lightbox = GLightbox({
                selector: '.glightbox-img-content img'
            });
        </script>
    </x-plugins.glightbox>
    <div class="bg-white px-6 py-32 lg:px-8 max-w-4xl mx-auto">
        <div class="text-base leading-7 text-gray-700">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $post->title }}</h1>
            @if ($post->hasMedia('thumbnail'))
                <div class="relative w-full block mt-6 glightbox-img-content">
                    <img
                        src="{{ $post->getFirstMediaUrl('thumbnail') }}"
                        alt=""
                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] cursor-pointer">
                    {{--                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>--}}
                </div>
            @endif
            <div
                class="prose glightbox-img-content max-w-none mt-6 [&>p>img]:cursor-pointer">
                {!! $post->body !!}
            </div>
            <x-gallery :gallery="$post->getMedia('gallery')"/>
            <x-files :files="$post->getMedia('files')"/>
        </div>
    </div>
</x-layout>
