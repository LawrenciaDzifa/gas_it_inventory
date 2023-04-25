<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;

    // push the records into the stockHistory table
    $stockHistory = new StockHistory;


    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
