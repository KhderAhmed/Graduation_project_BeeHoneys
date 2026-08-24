<?php

namespace App\Filament\Resources\CatgoryResource\Pages;

use App\Filament\Resources\CatgoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatgories extends ListRecords
{
    protected static string $resource = CatgoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
