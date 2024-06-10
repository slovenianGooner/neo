<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\Resources\ProductResource;
use App\Models\Template;
use App\Models\TemplateHelper;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditTemplateData extends EditRecord
{
    public static string $resource = ProductResource::class;

    protected static ?string $navigationLabel = 'Template Data';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Template Data';

    public function form(Form $form): Form
    {
        if (!$this->record->template) {
            return $form->schema([
                Placeholder::make('template')
                    ->columnSpanFull()
                    ->content('No template selected. Please select a template first in the "General" tab.')
            ]);
        }

        /**
         * @var Template $template
         */
        $template = TemplateHelper::getFromValue('Models/ProductTemplates', $this->record->template);

        // We show the template data schema based on selected template
        return $form->schema([
            Placeholder::make('template')
                ->columnSpanFull()
                ->label('Template: ' . $template::getName())
                ->content('Form for this template is defined in ' . $template . ' class.'),
            Grid::make()->statePath('template_data')->schema([
                ...$template::getSchema(),
            ]),
        ]);
    }
}
