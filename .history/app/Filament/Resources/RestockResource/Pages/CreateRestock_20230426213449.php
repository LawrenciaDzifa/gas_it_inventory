<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use App\Models\Stock;
use App\Models\StockHistory;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;

    protected function afterCreate()
    {
        //update stock quantity with restock quantity

        $stock = Stock::where('item_name', $this->record->item_name)->first();
        $stock->quantity += $this->record->restock_qty;
        $stock->save();

        //push record in stock history
        $stockHistory = new StockHistory();
        $stockHistory->item_name = $this->record->item_name;
        $stockHistory->quantity = $this->record->restock_qty;
        $stockHistory->user = Auth::user()->id;;
        $stockHistory->category_name = $stock->category_name;
        $stockHistory->type = 'restock';
        $stockHistory->save();
    }




    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
