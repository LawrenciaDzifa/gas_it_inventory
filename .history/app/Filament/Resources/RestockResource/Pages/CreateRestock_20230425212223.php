<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

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
            'stype' => 'restock',
            'stock_date' => $this->record->created_at,
            'user' => Auth::user()->name,
        ]);
        $this->record->item->stock_qty += $this->record->restock_qty;
        $this->record->item->save();
    }




    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
