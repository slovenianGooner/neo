@component('mail::message')
    # New Contact Us Form Submission

    There has been a new submission to the contact form on the website. Below are the details:

    - **Name:** {{ $name }}
    - **Email:** {{ $email }}
    - **Message:** {{ $message }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
