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

    // before a requisition is created check if the stock quantity is less than the quantity requested and if it is less than the quantity requested return an error message
    protected function beforeCreate(array $data): array
    {
        $stock = Stock::where('item_name', $data['item_name'])->first();
        if ($stock->quantity < $data['qty_requested']) {
            Flash::error('The quantity you are requesting is more that the quantity in stock')->important();
            return redirect(route('requisitions.index'));
        } else {
            return $data;
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
