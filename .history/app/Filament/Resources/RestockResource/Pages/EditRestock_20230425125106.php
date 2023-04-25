<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestock extends EditRecord
{
    protected static string $resource = RestockResource::class;
    // i want the item name to have the value of the item name in the database


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
