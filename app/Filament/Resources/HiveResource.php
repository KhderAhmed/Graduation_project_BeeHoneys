<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HiveResource\Pages;
use App\Filament\Resources\HiveResource\RelationManagers;
use App\Models\Hive;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class HiveResource extends Resource
{
    protected static ?string $model = Hive::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';
//   public static function getNavigationLabel(): string
//     {
//         return __('messages.about');
//     }

//     public static function getPluralLabel(): ?string
//     {
//         return __('messages.about');
//     }

//     public static function getLabel(): ?string
//     {
//         return __('messages.about');
//     }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    TextInput::make('name')
                        ->required()
                        ->label('اسم الخلية'),
                    TextInput::make('location')
                        ->label('الموقع'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('location'),
                TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListHives::route('/'),
            'create' => Pages\CreateHive::route('/create'),
            'edit' => Pages\EditHive::route('/{record}/edit'),
        ];
    }
}
