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
        $notifier = new SMSNotifier();
        $user = Auth::user();
        $phone = $user->phone;
        $msg = "Dear $user->name, your requisition has been submitted and is pending review. You will be notified of the next status soon. Thank you.";
        $notifier->send($phone, $msg);
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
