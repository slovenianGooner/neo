@props(['formId', 'error' => false])

@if (config('services.recaptcha.site_key'))
    <div id="captcha" wire:ignore class="hidden"></div>
    <x-input.error :error="$error"/>

    @push('js')
        <script
            src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script>
            function handle(e) {
                grecaptcha.ready(() => {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'})
                        .then(token => {
                            @this.
                            set('captcha', token)
                        })
                })
            }
        </script>
    @endpush
@endif
