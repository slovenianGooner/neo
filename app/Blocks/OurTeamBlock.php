<?php

namespace App\Blocks;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use FilamentTiptapEditor\TiptapBlock;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class OurTeamBlock extends TiptapBlock
{
    public string $width = '4xl';
    public string $preview = 'blocks.our-team.preview';
    public string $rendered = 'blocks.our-team.rendered';

    public function getFormSchema(): array
    {
        return [
            Grid::make()->schema([
                TextInput::make('title')->placeholder('Our team')->columnSpanFull(),
                Textarea::make('content')->placeholder('How do we describe our team?')->columnSpanFull(),
                Repeater::make('team_members')
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed()
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                    ->schema([
                        Hidden::make('id')->default(fn() => Str::random(12)),
                        TextInput::make('name')->placeholder('John Doe')->columnSpanFull(),
                        TextInput::make('position')->placeholder('CEO')->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->customProperties(fn(Get $get) => ['repeater_id' => $get('id')])
                            ->filterMediaUsing(fn(Collection $media, Get $get) => $media->where('custom_properties.repeater_id', $get('id')))
                            ->multiple()
                            ->maxFiles(1)
                            ->required(),
                        Repeater::make('social_links')
                            ->grid()
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(fn(array $state): ?string => $state['platform'] ?? null)
                            ->schema([
                                TextInput::make('platform')->placeholder('Twitter'),
                                TextInput::make('url')->placeholder('https://twitter.com/johndoe'),
                            ]),
                    ]),
            ])
        ];
    }
}
