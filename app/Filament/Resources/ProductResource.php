<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Set;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?int $navigationSort = 2;
    public static function getNavigationLabel(): string
    {
        return __('messages.product');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.product');
    }

    public static function getLabel(): ?string
    {
        return __('messages.product');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make(__('messages.cnp'))->tabs([
                    Tab::make('Tab 1')->icon('heroicon-o-rectangle-stack')

                        ->schema([
                            TextInput::make('title_ar')->required()->label(__('messages.title_ar')),
                            TextInput::make('title_en')->required()->label(__('messages.title_en')),
                            Select::make('catgory_id')->label(__('messages.categories_name_en'))
                                ->relationship(name: 'catgory', titleAttribute: 'title_en')->native(false)->visible(fn () => app()->getLocale() === 'en'),

                            Select::make('catgory_id')->label(__('messages.categories_name_ar'))
                                ->relationship(name: 'catgory', titleAttribute: 'title_ar')->native(false)->visible(fn () => app()->getLocale() === 'ar'),


                        ]),
                    Tab::make(__('messages.content'))->schema([
                        MarkdownEditor::make('description_ar')->label(__('messages.description_ar'))->required()->columnSpanFull(),
                        MarkdownEditor::make('description_en')->label(__('messages.description_en'))->required()->columnSpanFull(),
                    ]),
                    Tab::make(__('messages.meta'))->schema([
                        FileUpload::make('image')->label(__('messages.image'))->disk('public')->directory('/Products'),
                        TextInput::make('price')->label(__('messages.price'))->required(),
                        Checkbox::make('status')->label(__('messages.status'))->required(),
                    ]),
                ])->columnSpanFull()->activeTab(3)->persistTabInQueryString(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title_en')->label(__('messages.title_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('title_ar')->label(__('messages.title_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                TextColumn::make('catgory.title_en')->label(__('messages.categories_name_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                TextColumn::make('catgory.title_en')->label(__('messages.categories_name_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('price')->toggleable()->label(__('messages.price')),
                ImageColumn::make('image')->toggleable()->label(__('messages.image')),
                CheckboxColumn::make('status')->toggleable()->label(__('messages.status')),
                TextColumn::make('created_at')->date('Y M D')->label(__('messages.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
