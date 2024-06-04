@pushonce('css', 'glightbox-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css"/>
@endpushonce
@pushonce('js', 'glightbox-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
    @if (!$slot)
        <script type="text/javascript">
            const lightbox = GLightbox({
                selector: '.glightbox'
            });
        </script>
    @else
        {{ $slot }}
    @endif
@endpushonce
