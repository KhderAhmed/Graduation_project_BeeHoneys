<?php

namespace App\Filament\Resources\HiveReadingResource\Pages;

use App\Filament\Resources\HiveReadingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHiveReading extends EditRecord
{
    protected static string $resource = HiveReadingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
