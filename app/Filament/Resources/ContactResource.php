<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?int $navigationSort = 3;
    public static function getNavigationLabel(): string
    {
        return __('messages.contact');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.contact');
    }

    public static function getLabel(): ?string
    {
        return __('messages.contact');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->label(__('messages.name'))->searchable()->sortable(),
                TextColumn::make('phone')->label(__('messages.phone')),
                TextColumn::make('email')->label(__('messages.email')),
                TextColumn::make('message')->label(__('messages.message')),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D'),

            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
