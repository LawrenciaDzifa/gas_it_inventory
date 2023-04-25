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

    public static function createRecord(CreateRecordReques $request)
    {
        $record = static::fill(new static::$model(), $request->getInput());

        $record->save();

        $stock = Stock::where('item_name', $record->item_name)->first();
        $stock->quantity += $record->restock_qty;
        $stock->save();

        // create stock history
        $stockHistory = new StockHistory();
        $stockHistory->item_name = $record->item_name;
        $stockHistory->stock_qty = $stock->quantity;
        $stockHistory->user = Auth::user()->id;;
        $stockHistory->category_name = $stock->category_name;
        $stockHistory->type = 'Restocked';
        $stockHistory->save();

        return static::redirect('index', $record);
    }


    protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }
}
