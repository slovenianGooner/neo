<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitch extends Component
{
    public string $locale;

    public function mount(): void
    {
        $this->locale = $this->selectedLocale();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.language-switch');
    }

    public function switchLocale(string $locale): void
    {
        session()->put('locale', $locale);
        request()->user()->update(['session_language' => $locale]);

        $this->redirect(request()->header('Referer'));
    }

    public function availableLocales(): array
    {
        return collect(config('neo.locales'))
            ->toArray();
    }

    public function hasMultipleLocales(): bool
    {
        return count($this->availableLocales()) > 1;
    }

    public function selectedLocale()
    {
        return session('locale', 'en');
    }

    public function selectedLocaleLabel(): string
    {
        return $this->getLabel($this->selectedLocale());
    }

    public function getLabel(string $locale): string
    {
        return $this->availableLocales()[$locale];
    }

    public function getCharAvatar(string $locale): string
    {
        return str($locale)->length() > 2
            ? str($locale)->substr(0, 2)->upper()->toString()
            : str($locale)->upper()->toString();
    }

}
