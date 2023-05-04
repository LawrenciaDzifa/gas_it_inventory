<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use App\Http\Controllers\SMSController;
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
    protected function mutateResourceAfterCreate()
    {
        $pendingSMS = new SMSController;
                $user = Auth::user();
                $phone = $user->phone;
                // $requisition = Requisition::latest()->first();
                // $item = Item::find($requisition->item_name);
                $msg = "Dear $user->name, your requisition has been submitted and is pendig. You will notified of the next status soon. Thank you.";
                $pendingSMS->sendSMS($phone, $msg);
                

    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
