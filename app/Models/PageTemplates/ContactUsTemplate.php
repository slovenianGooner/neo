<?php

namespace App\Models\PageTemplates;

use App\Models\Template;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class ContactUsTemplate implements Template
{
    public static function getName(): string
    {
        return "Contact Us";
    }

    public static function getKey(): string
    {
        return "contact_us";
    }

    public static function getSchema(): array
    {
        return [
            Repeater::make('offices')
                ->columnSpanFull()
                ->label('Offices')
                ->addActionLabel('Add Office')
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('address')
                        ->label('Address')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->required(),
                ]),
        ];
    }

    public static function getTemplatePath(): string
    {
        return 'page-templates.contact_us';
    }
}
