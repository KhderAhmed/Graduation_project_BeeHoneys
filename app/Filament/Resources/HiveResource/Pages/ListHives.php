<?php

namespace App\Filament\Resources\HiveResource\Pages;

use App\Filament\Resources\HiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHives extends ListRecords
{
    protected static string $resource = HiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
