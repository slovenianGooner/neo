<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product\SpecificationType;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Tables\Table;
use Filament\Tables;

class ManageSpecification extends ManageRelatedRecords
{
    protected static string $resource = ProductResource::class;

    protected static string $relationship = 'specifications';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Specifications';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type_id')
                    ->label('Type')
                    ->live()
                    ->options(SpecificationType::query()->pluck('name', 'id'))->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->live()
                    ->visible(fn(Forms\Get $get) => SpecificationType::find($get('type_id'))?->type === 'text')
                    ->required(),
                Forms\Components\Select::make('value')
                    ->label('Value')
                    ->live()
                    ->visible(fn(Forms\Get $get) => SpecificationType::find($get('type_id'))?->type === 'select')
                    ->options(fn(Forms\Get $get) => collect(SpecificationType::find($get('type_id'))?->options)->mapWithKeys(fn($option) => [$option => $option]))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type.name'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
