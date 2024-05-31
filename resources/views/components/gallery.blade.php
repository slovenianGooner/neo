@props(['gallery'])

@if ($gallery->count())
    <x-plugins.glightbox/>
    <div class="mt-4 max-w-2xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            @foreach($gallery as $image)
                <div class="overflow-hidden rounded-lg shadow-md">
                    <a href="{{ $image->getUrl() }}" class="glightbox">
                        <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}"
                             class="w-full h-auto transition-transform duration-300 ease-in-out transform hover:scale-105"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
