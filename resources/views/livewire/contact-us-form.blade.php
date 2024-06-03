<div>
    <form class="flex flex-col" wire:submit="sendForm" id="contactUsForm" method="post">

        @if ($successMessage)
            <x-input.success-alert>{{ $successMessage }}</x-input.success-alert>
        @endif

        <div>
            <x-input.label for="name">Name</x-input.label>
            <x-input.text wire:model="name" name="name" :error="$errors->get('name')"/>
            <x-input.error :error="$errors->get('name')"/>
        </div>
        <div class="mt-4">
            <x-input.label for="email">E-mail</x-input.label>
            <x-input.text wire:model="email" name="email" :error="$errors->get('email')"/>
            <x-input.error :error="$errors->get('email')"/>
        </div>
        <div class="mt-4">
            <x-input.label for="message">Message</x-input.label>
            <x-input.textarea wire:model="message" name="message" :error="$errors->get('message')"/>
            <x-input.error :error="$errors->get('message')"/>
        </div>

        <x-input.captcha :error="$errors->get('captcha')" class="mt-4"/>

        <button type="submit"
                @if (config('services.recaptcha.site_key'))
                    data-sitekey="{{ config('services.recaptcha.site_key') }}"
                data-callback="handle"
                data-action="submit"
                @endif
                class="{{ config('services.recaptcha.site_key') ? 'g-recaptcha' : '' }} mt-4 w-32 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Submit
        </button>
    </form>
</div>
