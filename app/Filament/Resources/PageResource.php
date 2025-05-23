<?php

namespace App\Filament\Resources;

use App\Filament\Actions\MoveAction;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use App\Models\PageTemplates\PageTemplateHelper;
use App\Models\TemplateHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $slug = 'pages';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('active')
                    ->default(true)
                    ->required(),
                Forms\Components\Toggle::make('homepage')
                    ->default(false)
                    ->columnStart(1)
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->columnStart(1)
                    ->label('Parent Page')
                    ->allowHtml()
                    ->options(function () {
                        return Page::orderBy('_lft')->get()
                            ->mapWithKeys(function (Page $page) {
                                return [$page->id => $page->getIndentedTitle()];
                            });
                    }),
                Forms\Components\TextInput::make('title')
                    ->columnStart(1)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255),
                TiptapEditor::make('body')
                    ->output(TiptapOutput::Json)
                    ->columnSpanFull()
                    ->maxContentWidth('full'),
                Forms\Components\Select::make('template')
                    ->columnStart(1)
                    ->label('Template')
                    ->options(TemplateHelper::getTemplateOptions('Models/PageTemplates')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                $query->orderBy('_lft')->where('locale', session_locale());
            })
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->html()
                    ->formatStateUsing(function (Page $record) {
                        return $record->getIndentedTitle();
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('homepage')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                MoveAction::make('move_up')->direction('up'),
                MoveAction::make('move_down')->direction('down'),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
            'edit-template-data' => Pages\EditTemplateData::route('/{record}/template-data'),
            'posts' => Pages\ManagePosts::route('/{record}/posts'),
        ];
    }

    public static function getRecordSubNavigation(\Filament\Resources\Pages\Page $page): array
    {
        $subNavigation = [
            'edit' => Pages\EditPage::class,
            'edit-template-data' => Pages\EditTemplateData::class,
            'posts' => Pages\ManagePosts::class,
        ];

        return $page->generateNavigationItems($subNavigation);
    }
}
