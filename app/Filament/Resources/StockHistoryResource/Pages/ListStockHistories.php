<?php

namespace App\Filament\Resources\StockHistoryResource\Pages;

use App\Filament\Resources\StockHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockHistories extends ListRecords
{
    protected static string $resource = StockHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
