<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Enums\Currency;
use App\Filament\Resources\ProductResource;
use App\Models\Product\SpecificationType;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Support\RawJs;
use Filament\Tables\Table;
use Filament\Tables;

class ManagePrices extends ManageRelatedRecords
{
    protected static string $resource = ProductResource::class;

    protected static string $relationship = 'prices';

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    public static function getNavigationLabel(): string
    {
        return 'Prices';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->placeholder('0.00')
                    ->required(),
                Forms\Components\Select::make('currency')
                    ->label('Currency')
                    ->options(Currency::getOptions())
                    ->default(Currency::EUR)
                    ->required(),
                Forms\Components\DatePicker::make('valid_from')
                    ->placeholder('YYYY-MM-DD')
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('valid_to')
                    ->placeholder('YYYY-MM-DD')
                    ->native(false)
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull()
                    ->label('Note'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->grow(false),
                Tables\Columns\TextColumn::make('currency')
                    ->grow(false),
                Tables\Columns\TextColumn::make('valid_from')
                    ->formatStateUsing(function ($state) {
                        return $state->format('Y-m-d');
                    })->sortable(),
                Tables\Columns\TextColumn::make('valid_to')
                    ->formatStateUsing(function ($state) {
                        return $state->format('Y-m-d');
                    })->sortable(),
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
