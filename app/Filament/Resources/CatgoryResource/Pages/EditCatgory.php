<?php

namespace App\Filament\Resources\CatgoryResource\Pages;

use App\Filament\Resources\CatgoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatgory extends EditRecord
{
    protected static string $resource = CatgoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
