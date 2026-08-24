<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms\Components\{MarkdownEditor, Tabs, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?int $navigationSort = 8;
    protected static ?string $model = About::class;
    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';

    public static function getNavigationLabel(): string
    {
        return __('messages.about');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.about');
    }

    public static function getLabel(): ?string
    {
        return __('messages.about');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->tabs([
                Tabs\Tab::make(__('messages.methodabout'))->schema([
                    ...collect(['title_ar', 'title_en'])->map(
                        fn($field) =>
                        TextInput::make($field)->required()->label(__('messages.' . $field))
                    ),
                    ...collect(['description_ar', 'description_en'])->map(
                        fn($field) =>
                        MarkdownEditor::make($field)->label(__('messages.' . $field))->required()->columnSpanFull()
                    ),
                ])
            ])->columnSpanFull()
        ]);
    }
    public static function table(Table $table): Table
    {
        $locale = app()->getLocale();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label(__('messages.id'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make("title_{$locale}")->label(__('messages.title_' . $locale))->searchable()->sortable(),
                Tables\Columns\TextColumn::make("description_{$locale}")->label(__('messages.description_' . $locale))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('messages.created_at'))->time('Y-M-D'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
