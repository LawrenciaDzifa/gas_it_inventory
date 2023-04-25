<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestock extends EditRecord
{
    protected static string $resource = RestockResource::class;
    // i want the item name field to automaticaly have the value of the item name in the database
    // i want the qty_requested field to automaticaly have the value of the qty_requested in the database

    public static function getQuery()
    {
        return parent::getQuery()->withoutGlobalScope('restock');
        
    }



    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
