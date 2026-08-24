<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ChatPage extends Page
{
 protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string $view = 'filament.pages.chat-page';
    protected static ?string $navigationLabel = 'الدردشة';
    protected static ?string $navigationGroup = 'التطبيق';
    protected static ?string $slug = 'chat';
}
