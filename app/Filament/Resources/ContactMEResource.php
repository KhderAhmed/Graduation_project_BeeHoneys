<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMEResource\Pages;
use App\Filament\Resources\ContactMEResource\RelationManagers;
use App\Models\ContactME;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMEResource extends Resource
{
    protected static ?string $model = Contactme::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';
    protected static ?int $navigationSort = 4;
    public static function getNavigationLabel(): string
    {
        return __('messages.team');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.team');
    }

    public static function getLabel(): ?string
    {
        return __('messages.team');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make()->tabs([
                    Tab::make(__('messages.oft'))
                        ->schema([
                            TextInput::make('name_ar')->required()->label(__('messages.name_ar')),
                            TextInput::make('name_en')->required()->label(__('messages.name_en')),
                            TextInput::make('phone')->label(__('messages.phone'))->required(),
                            TextInput::make('email')->label(__('messages.email'))->required(),
                            Checkbox::make('status')->label(__('messages.status'))->required(),

                        ]),

                ])->columnSpanFull(),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name_en')->label(__('messages.name_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('name_ar')->label(__('messages.name_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                CheckboxColumn::make('status')->label(__('messages.status'))->toggleable(),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D'),
                TextColumn::make('phone')->label(__('messages.phone')),
                TextColumn::make('email')->label(__('messages.email')),
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
            'index' => Pages\ListContactMES::route('/'),
            'create' => Pages\CreateContactME::route('/create'),
            'edit' => Pages\EditContactME::route('/{record}/edit'),
        ];
    }
}
