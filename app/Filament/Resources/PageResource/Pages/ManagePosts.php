<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;

class ManagePosts extends ManageRelatedRecords
{
    protected static string $resource = PageResource::class;

    protected static string $relationship = 'posts';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Posts';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('body')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                    ->collection('gallery')
                    ->image()
                    ->imageResizeTargetWidth(1200)
                    ->multiple()
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('files')
                    ->collection('files')
                    ->multiple()
                    ->preserveFilenames()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('order'),
                Tables\Columns\TextColumn::make('title')->grow(),
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
