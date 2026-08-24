<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';
    protected static ?int $navigationSort = 5;
    public static function getNavigationLabel(): string
    {
        return __('messages.client');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.client');
    }

    public static function getLabel(): ?string
    {
        return __('messages.client');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->label(__('messages.name'))->searchable()->sortable(),
                TextColumn::make('email')->label(__('messages.email')),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D'),
            ])
            ->filters([
                //
            ])
            ->actions([

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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
