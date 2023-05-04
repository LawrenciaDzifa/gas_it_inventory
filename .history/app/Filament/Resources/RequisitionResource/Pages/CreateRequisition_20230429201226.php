<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use App\Models\Stock;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user'] = auth()->id();
        $data['status'] = 'Pending';
        return $data;
    }
    protected function afterCreate()
    {
        $stock = Stock::where('item_id', $this->record->item_name)->first();
        $stock->qty = $stock->qty - $this->record->qty_requested;
        $stock->save();
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
