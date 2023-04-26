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

    // before a requisition is saves check if the stock quantity is less than the quantity requested and
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
