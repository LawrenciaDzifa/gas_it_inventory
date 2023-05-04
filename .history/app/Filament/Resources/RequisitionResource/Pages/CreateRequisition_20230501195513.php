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
        $phone = Auth::user()->phone;
        $pendingSMS = new SMSController();
        $pendingSMS->sendSMS(
            'Your requisition has been submitted and pending. You will be notified of the next status update.',
            $phone
        );

    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
