<?php

namespace App\Filament\Resources\ClientReaquestResource\Pages;

use App\Filament\Resources\ClientReaquestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientReaquest extends EditRecord
{
    protected static string $resource = ClientReaquestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
