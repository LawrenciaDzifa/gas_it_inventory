<?php

namespace App\Filament\Resources\RestockResource\Pages;

use App\Filament\Resources\RestockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestock extends EditRecord
{
    protected static string $resource = RestockResource::class;
    public function formComponents(): array
    {
        $record = $this->getRecord();

        $item = $record->item;

        $itemName = $item ? $item->name : '';

        return [
            Components\TextInput::make('item_name')
                ->label('Item Name')
                ->disabled()
                ->value($itemName),
            // Other form fields for editing the restock record
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
