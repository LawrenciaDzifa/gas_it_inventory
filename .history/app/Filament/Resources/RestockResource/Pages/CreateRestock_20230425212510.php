<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;

//  after creating a restock, i want to push the records to stockHistory table and update the stock table
    protected function afterCreate()
    {
        $this->record->save();
        $this->record->stockHistory()->create([
            'item_name' => $this->record->item_name,
            'restock_qty' => $this->record->restock_qty,
            'type' => 'restock',
            'user' => Auth::user()->id(),
        ]);

        $this->record->stock->quantity += $this->record->restock_qty;
        $this->record->stock->save();
    }




    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
