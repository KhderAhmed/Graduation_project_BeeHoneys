<?php

namespace App\Filament\Resources\ContactMEResource\Pages;

use App\Filament\Resources\ContactMEResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactMES extends ListRecords
{
    protected static string $resource = ContactMEResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
