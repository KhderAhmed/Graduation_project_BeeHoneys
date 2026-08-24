<?php

namespace App\Filament\Resources\ClientReaquestResource\Pages;

use App\Filament\Resources\ClientReaquestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientReaquests extends ListRecords
{
    protected static string $resource = ClientReaquestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
