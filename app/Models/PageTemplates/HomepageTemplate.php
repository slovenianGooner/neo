<?php

namespace App\Models\PageTemplates;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HomepageTemplate implements PageTemplate
{

    public static function getName(): string
    {
        return 'Homepage';
    }

    public static function getKey(): string
    {
        return 'homepage';
    }

    public static function getTemplatePath(): string
    {
        return 'page-templates.homepage';
    }

    public static function getSchema(): array
    {
        return [
            Tabs::make()->columnSpanFull()->persistTabInQueryString()->schema([
                Tabs\Tab::make('Hero')->schema([
                    Fieldset::make('top_link')->label('Top Link')->schema([
                        TextInput::make('top_link_text')->label('Text'),
                        TextInput::make('top_link_url')->label('URL'),
                        TextInput::make('top_link_read_more_text')->label('Read More')->default('Read More')
                    ]),
                    TextInput::make('hero_title')->label('Title'),
                    Textarea::make('hero_text')->label('Text'),
                    Fieldset::make('hero_cta')->label('CTA')->schema([
                        TextInput::make('hero_cta_text')->label('Text'),
                        TextInput::make('hero_cta_url')->label('URL'),
                    ]),
                    Fieldset::make('hero_secondary_cta')->label('CTA')->schema([
                        TextInput::make('hero_secondary_cta_text')->label('Text'),
                        TextInput::make('hero_secondary_cta_url')->label('URL'),
                    ]),
                    SpatieMediaLibraryFileUpload::make('hero_image')->label('Image')->collection('hero_image')
                ]),
                Tabs\Tab::make('Features')->schema([
                    TextInput::make('features_subtitle')->label('Subtitle'),
                    TextInput::make('features_title')->label('Title'),
                    Textarea::make('features_text')->label('Text'),
                    Repeater::make('features')->grid()->collapsible()->collapsed()->itemLabel(fn(array $state) => $state['title'])->schema([
                        TextInput::make('title')->label('Title'),
                        Textarea::make('text')->label('Text'),
                        TextInput::make('url')->label('URL'),
                        TextInput::make('link_text')->label('Link Text'),
                    ])
                ]),
                Tabs\Tab::make('Call-To-Action')->schema([
                    Textarea::make('cta_title')->label('Title'),
                    Textarea::make('cta_text')->label('Text'),
                    Fieldset::make('primary_cta')->label('Secondary CTA')->schema([
                        TextInput::make('primary_cta_text')->label('Text'),
                        TextInput::make('primary_cta_url')->label('URL'),
                    ]),
                    Fieldset::make('secondary_cta')->label('Primary CTA')->schema([
                        TextInput::make('secondary_cta_text')->label('Text'),
                        TextInput::make('secondary_cta_url')->label('URL'),
                    ]),
                ]),
            ])
        ];
    }
}
