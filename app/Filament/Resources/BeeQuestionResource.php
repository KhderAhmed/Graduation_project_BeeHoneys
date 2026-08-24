<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeeQuestionResource\Pages;
use App\Filament\Resources\BeeQuestionResource\RelationManagers;
use App\Models\BeeQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{MarkdownEditor, Tabs, TextInput, Textarea};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeeQuestionResource extends Resource
{
    protected static ?string $model = BeeQuestion::class;
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    public static function getNavigationLabel(): string
    {
        return __('messages.Frequently Asked Questions');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.Frequently Asked Questions');
    }

    public static function getLabel(): ?string
    {
        return __('messages.Frequently Asked Questions');
    }

    public static function form(Form $form): Form
    {

        return $form->schema([
            Tabs::make()->tabs([
                Tabs\Tab::make(__('messages.Questions'))->schema([
                    ...collect(['question_ar', 'question_en'])->map(
                        fn($field) =>
                        TextInput::make($field)->required()->label(__('messages.' . $field))
                    ),
                    ...collect(['answer_ar', 'answer_en'])->map(
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
                Tables\Columns\TextColumn::make("question_{$locale}")->label(__('messages.question_' . $locale))->searchable()->sortable(),
                Tables\Columns\TextColumn::make("answer_{$locale}")->label(__('messages.answer_' . $locale))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('messages.created_at'))->time('Y-M-D'),
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
            'index' => Pages\ListBeeQuestions::route('/'),
            'create' => Pages\CreateBeeQuestion::route('/create'),
            'edit' => Pages\EditBeeQuestion::route('/{record}/edit'),
        ];
    }
}
