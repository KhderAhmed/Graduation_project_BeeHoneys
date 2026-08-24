<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CodeResource\Pages;
use App\Filament\Resources\CodeResource\RelationManagers;
use App\Models\Code;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid as ComponentsGrid;
use Filament\Forms\Components\Hidden;

class CodeResource extends Resource
{
    protected static ?string $model = Code::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';
    public static function getNavigationLabel(): string
    {
        return __('messages.code');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.code');
    }

    public static function getLabel(): ?string
    {
        return __('messages.code');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ComponentsGrid::make(1)->schema([
                    TextInput::make(__('messages.code'))->make('code')
                        ->default(fn() => Code::generate(8))
                        ->unique()
                        ->required(),
                    Hidden::make('created_by')
                        ->default(fn() => auth()->id()),

                    DateTimePicker::make(name: __('messages.expires_at')),
                    Select::make('beekeeper_id')->label(__('messages.beekeeper_id'))
                        ->relationship('beekeeper', 'name')
                        ->searchable()
                 
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable()->copyable()->label(__('messages.code')),
                BooleanColumn::make('is_redeemed')->label(__('messages.is_redeemed')),
                TextColumn::make('beekeeper.name')->label(__('messages.beekeeper_id')),
                TextColumn::make('expires_at')->dateTime()->label(__('messages.expires_at')),
                TextColumn::make('redeemed_at')->dateTime()->label(__('messages.redeemed_at')),
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
            'index' => Pages\ListCodes::route('/'),
            'create' => Pages\CreateCode::route('/create'),
            'edit' => Pages\EditCode::route('/{record}/edit'),
        ];
    }
}
