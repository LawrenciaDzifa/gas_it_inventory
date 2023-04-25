<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;

//  after creating a restock, i want to sendd the records to stockHistory table as well
//  but i dont know how to do it



    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
