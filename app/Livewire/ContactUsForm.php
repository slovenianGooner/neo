<?php

namespace App\Livewire;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactUsForm extends Component
{
    #[Validate('required')]
    public string $name = '';
    #[Validate(['required', 'email'])]
    public string $email = '';
    #[Validate('required')]
    public string $message = '';
    #[Validate('required|accepted')]
    public bool $captcha = false;

    public string $successMessage = '';

    protected function getMessages()
    {
        return [
            'name.required' => word('neo.name_required'),
            'email.required' => word('neo.email_required'),
            'email.email' => word('neo.email_email'),
            'message.required' => word('neo.message_required'),
            'captcha.accepted' => word('neo.captcha_required'),
        ];
    }

    public function mount(string $locale): void
    {
        app()->setLocale($locale);
    }

    public function render(): View
    {
        return view('livewire.contact-us-form');
    }

    public function updatedCaptcha($token): void
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . config('services.recaptcha.secret_key') . '&response=' . $token);
        $this->captcha = $response->json()['success'];
        $this->sendForm();
    }

    public function sendForm(): void
    {
        $this->validate();

        // Send the email
        Mail::to(config('mail.from.address'))
            ->send(new ContactUsMail(app()->getLocale(), $this->name, $this->email, $this->message));

        $this->successMessage = word('neo.contact_us_success');
    }
}
