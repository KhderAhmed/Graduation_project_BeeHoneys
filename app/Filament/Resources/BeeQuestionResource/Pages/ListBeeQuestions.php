<?php

namespace App\Filament\Resources\BeeQuestionResource\Pages;

use App\Filament\Resources\BeeQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeeQuestions extends ListRecords
{
    protected static string $resource = BeeQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
