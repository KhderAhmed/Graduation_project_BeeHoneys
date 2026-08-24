<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?int $navigationSort = 7;

    public static function getNavigationLabel(): string
    {
        return __('messages.blog');
    }

    public static function getPluralLabel(): ?string
    {
        return __('messages.blog');
    }

    public static function getLabel(): ?string
    {
        return __('messages.blog');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make(__('messages.create new post'))->tabs([
                    Tab::make('Tab 1')->icon('heroicon-o-rectangle-stack')
                        ->schema([
                            TextInput::make('title_ar')->required()->label(__('messages.title_ar')),
                            TextInput::make('title_en')->required()->label(__('messages.title_en')),
                            Forms\Components\Select::make('user_id')->label(__('messages.writer'))
                                ->relationship('user', 'name')
                                ->required(),
                        ]),
                    Tab::make(__('messages.content'))->schema([
                        MarkdownEditor::make('description_ar')->label(__('messages.description_ar'))->required()->columnSpanFull(),
                        MarkdownEditor::make('description_en')->label(__('messages.description_en'))->required()->columnSpanFull(),
                    ]),
                    Tab::make(__('messages.meta'))->schema([
                        FileUpload::make('image')->label(__('messages.image'))->disk('public')->directory('/blog/'),
                        Checkbox::make('status')->label(__('messages.status'))->required(),
                    ]),
                ])->columnSpanFull()->activeTab(3)->persistTabInQueryString(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('messages.id'))->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title_en')->label(__('messages.title_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('title_ar')->label(__('messages.title_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                TextColumn::make('description_en')->label(__('messages.description_en'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'en'),
                TextColumn::make('description_ar')->label(__('messages.description_ar'))->searchable()->sortable()->visible(fn () => app()->getLocale() === 'ar'),
                TextColumn::make('user.name')->label(__('messages.writer'))->sortable()->searchable(),
                ImageColumn::make('image')->label(__('messages.image'))->toggleable(),
                CheckboxColumn::make('status')->label(__('messages.status'))->toggleable(),
                TextColumn::make('created_at')->label(__('messages.created_at'))->date('Y M D')->sortable()->searchable()->toggleable(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
