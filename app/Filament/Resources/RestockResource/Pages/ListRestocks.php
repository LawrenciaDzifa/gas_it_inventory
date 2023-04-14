<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRestocks extends ListRecords
{
    protected static string $resource = RestockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
