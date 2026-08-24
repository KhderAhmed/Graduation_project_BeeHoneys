<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientReaquestResource\Pages;
use App\Filament\Resources\ClientReaquestResource\RelationManagers;
use App\Models\ClientReaquest;
use App\Models\ClientRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientReaquestResource extends Resource
{
    protected static ?string $model = ClientRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt-slash';
    protected static ?int $navigationSort = 6;
    public static function getNavigationLabel(): string
    {
        return __('messages.UserRequests');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.UserRequests');
    }

    public static function getLabel(): ?string
    {
        return __('messages.UserRequests');
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
                TextColumn::make('title_en')->label(__('messages.title_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('title_ar')->label(__('messages.title_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                TextColumn::make('client.name')->label(__('messages.writer'))->sortable()->searchable(),
                CheckboxColumn::make('status')->label(__('messages.status'))->toggleable(),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D'),
                TextColumn::make('description_en')->label(__('messages.description_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('description_ar')->label(__('messages.description_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientReaquests::route('/'),
            'create' => Pages\CreateClientReaquest::route('/create'),
            'edit' => Pages\EditClientReaquest::route('/{record}/edit'),
        ];
    }
}
