@component('mail::message')
    # {{ word('neo.contact_us_mail_subject') }}

    {{ word('neo.contact_us_mail_message') }}

    - **{{ word('neo.name') }}**: {{ $name }}
    - **{{ word('neo.email') }}**: {{ $email }}
    - **{{ word('neo.message') }}**: {{ $message }}

    {{ word('neo.thanks') }},<br>
    {{ config('app.name') }}
@endcomponent
