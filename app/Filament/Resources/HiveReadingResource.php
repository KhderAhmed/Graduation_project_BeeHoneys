<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HiveReadingResource\Pages;
use App\Filament\Resources\HiveReadingResource\RelationManagers;
use App\Models\HiveReading;
use Filament\Forms;
use Filament\Forms\Components\Grid as ComponentsGrid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class HiveReadingResource extends Resource
{
    protected static ?string $model = HiveReading::class;

    protected static ?string $navigationIcon = 'heroicon-o-cloud';
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
                ComponentsGrid::make(1)->schema([
                    Select::make('hive_id')
                        ->relationship('hive', 'name')
                        ->label('خلية')
                        ->required(),
                    TextInput::make('temperature')->numeric()->label('حرارة'),
                    TextInput::make('humidity')->numeric()->label('رطوبة'),
                    TextInput::make('weight')->numeric()->label('وزن'),
                    TextInput::make('co2')->numeric()->label('CO₂'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hive.name')->label('خلية'),
                TextColumn::make('temperature')->label('🌡 حرارة')->sortable(),
                TextColumn::make('humidity')->label('💧 رطوبة')->sortable(),
                TextColumn::make('weight')->label('⚖ وزن')->sortable(),
                TextColumn::make('co2')->label('🟢 CO₂')->sortable(),
                TextColumn::make('created_at')->dateTime()->label('التاريخ'),
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
            'index' => Pages\ListHiveReadings::route('/'),
            'create' => Pages\CreateHiveReading::route('/create'),
            'edit' => Pages\EditHiveReading::route('/{record}/edit'),
        ];
    }
}
