<?php

namespace App\Filament\Resources\StockHistoryResource\Pages;

use App\Filament\Resources\StockHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockHistory extends EditRecord
{
    protected static string $resource = StockHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
