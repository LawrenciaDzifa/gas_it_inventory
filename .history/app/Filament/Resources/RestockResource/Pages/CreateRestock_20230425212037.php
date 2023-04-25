<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;

//  after creating a restock, i want to push the records to stockHistory table and update the stock table





    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
