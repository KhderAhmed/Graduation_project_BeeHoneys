<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-gif';
    protected static ?int $navigationSort = 9;
    public static function getNavigationLabel(): string
    {
        return __('messages.video');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.video');
    }

    public static function getLabel(): ?string
    {
        return __('messages.video');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('attachment')->label(__('messages.video'))
                ->required()
                ->preserveFilenames()
                ->maxSize(20000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id')),
                TextColumn::make('attachment')->label(__('messages.video')),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
