<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatgoryResource\Pages;
use App\Filament\Resources\CatgoryResource\RelationManagers;
use App\Models\Catgory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\Checkbox;
class CatgoryResource extends Resource
{
    protected static ?string $model = Catgory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    protected static ?int $navigationSort = 7;
    public static function getNavigationLabel(): string
    {
        return __('messages.category');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.category');
    }

    public static function getLabel(): ?string
    {
        return __('messages.category');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make(__('messages.create new category'))->tabs([
                    Tab::make(__('messages.category'))->schema([
                        TextInput::make('title_ar')->required()->label(__('messages.title_ar')),
                        TextInput::make('title_en')->required()->label(__('messages.title_en')),
                        Checkbox::make('status')->label(__('messages.status'))->required(),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title_en')->label(__('messages.title_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('title_ar')->label(__('messages.title_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                CheckboxColumn::make('status')->label(__('messages.status'))->toggleable(),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D')->sortable()->searchable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCatgories::route('/'),
            'create' => Pages\CreateCatgory::route('/create'),
            'edit' => Pages\EditCatgory::route('/{record}/edit'),
        ];
    }
}
