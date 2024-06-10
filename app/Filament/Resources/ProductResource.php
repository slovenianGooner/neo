<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Page;
use App\Models\Product;
use App\Models\TemplateHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Store';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->columnStart(1)
                    ->label('Category')
                    ->allowHtml()
                    ->options(function () {
                        return Page::where('products_page', true)->orderBy('_lft')->get()
                            ->mapWithKeys(function (Page $page) {
                                return [$page->id => $page->getBreadcrumbs(session_locale())];
                            });
                    }),
                Forms\Components\TextInput::make('title')
                    ->columnStart(1)
                    ->required()
                    ->maxLength(255),
                Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection('thumbnail')
                    ->columnStart(1)
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth(800)
                    ->imageResizeTargetHeight(800)
                    ->required(),
                TiptapEditor::make('body')
                    ->columnSpanFull()
                    ->maxContentWidth('full'),
                Forms\Components\Select::make('template')
                    ->columnStart(1)
                    ->label('Template')
                    ->options(TemplateHelper::getTemplateOptions('Models/ProductTemplates')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->formatStateUsing(function ($state, Product $record) {
                        return $record->category->getBreadcrumbs(session_locale());
                    })
                    ->html()
                    ->sortable()
            ])
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->searchable()
                    ->modifyQueryUsing(function ($query, $state) {
                        if (!$state["value"]) {
                            return $query;
                        }

                        return $query->whereIn('category_id', Page::find($state["value"])->descendantsAndSelf($state["value"])->pluck('id')->toArray());
                    })
                    ->options(function () {
                        return Page::where('products_page', true)->orderBy('_lft')->get()
                            ->mapWithKeys(function (Page $page) {
                                return [$page->id => $page->getBreadcrumbs(session_locale())];
                            });
                    })->indicateUsing(function ($state) {
                        if (!$state["value"]) {
                            return null;
                        }
                        return "Category: " . Page::find($state["value"])->getBreadcrumbs(session_locale());
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'edit-template-data' => Pages\EditTemplateData::route('/{record}/template-data'),
            'specifications' => Pages\ManageSpecification::route('/{record}/specifications'),
            'prices' => Pages\ManagePrices::route('/{record}/prices'),
        ];
    }

    public static function getRecordSubNavigation(\Filament\Resources\Pages\Page $page): array
    {
        $subNavigation = [
            'edit' => Pages\EditProduct::class,
            'edit-template-data' => Pages\EditTemplateData::class,
            'specifications' => Pages\ManageSpecification::class,
            'prices' => Pages\ManagePrices::class,
        ];

        return $page->generateNavigationItems($subNavigation);
    }
}
