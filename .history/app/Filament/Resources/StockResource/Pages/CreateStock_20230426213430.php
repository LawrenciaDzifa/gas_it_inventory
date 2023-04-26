<?php

namespace App\Filament\Resources\StockResource\Pages;

use App\Filament\Resources\StockResource;
use App\Models\StockHistory;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateStock extends CreateRecord
{
    protected static string $resource = StockResource::class;
    protected function afterCreate()
    {
        //push record in stock history
        $stockHistory = new StockHistory();
        $stockHistory->item_name = $this->record->item_name;
        $stockHistory->quantity = $this->record->quantity;
        $stockHistory->user = Auth::user()->id;;
        $stockHistory->category_name = $this->record->category_name;
        $stockHistory->type = 'Initial stock';
        $stockHistory->save();
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
