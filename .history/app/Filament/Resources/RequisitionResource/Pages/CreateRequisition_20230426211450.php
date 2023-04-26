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
    public static function actions(): array
    {
        return [
            Actions\Save::make()
                ->canSee(function () {
                    $stock = Stock::where('item_name', $this->record->item_name)->first();
                    if ($stock->quantity < $this->record->qty_requested) {
                        return false;
                    } else {
                        return true;
                    }
                })
                ->canRun(function () {
                    $stock = Stock::where('item_name', $this->record->item_name)->first();
                    if ($stock->quantity < $this->record->qty_requested) {
                        return false;
                    } else {
                        return true;
                    }
                })
                ->successMessage('Requisition created successfully.')
                ->errorMessage('The quantity you are requesting is more that the quantity in stock')
                ->redirectsTo('index'),
        ];
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
