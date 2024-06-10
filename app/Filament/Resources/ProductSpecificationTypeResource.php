<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductSpecificationTypeResource\Pages;
use App\Models\Product\SpecificationType;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductSpecificationTypeResource extends Resource
{
    protected static ?string $model = SpecificationType::class;

    protected static ?string $slug = 'product-specification-types';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Store';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'select' => 'Select',
                    ])->live()->required(),
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('e.g. Size'),
                TagsInput::make('options')
                    ->placeholder('e.g. Small, Medium, Large')
                    ->visible(fn(Get $get) => $get('type') === 'select')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('options')
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductSpecificationTypes::route('/'),
            'create' => Pages\CreateProductSpecificationType::route('/create'),
            'edit' => Pages\EditProductSpecificationType::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
