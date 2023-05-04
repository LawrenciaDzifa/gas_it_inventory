<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use App\Http\Controllers\SMSController;
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
       $pendingSMS= new SMSController();
         $pendingSMS->sendSMS(
            Auth::user()->phone,
            'Your requisition has been submitted and pending. You will be notified when it is approved.'
         );
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
