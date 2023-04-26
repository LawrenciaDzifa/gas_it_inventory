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

    protected function beforeCreate(){

        $stock=Stock::where('item_id', $this->record->item_name)->first();

        if($this->record->qty_requested > $stock->quantity){
            return redirect()->back()->with('error', 'Quantity requested is more than quantity in stock');
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user'] = auth()->id();
    $data['status'] = 'Pending';
    return $data;
}
// after a requisition is created i want to send an sms to user using arkesel sms api




protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }

}
