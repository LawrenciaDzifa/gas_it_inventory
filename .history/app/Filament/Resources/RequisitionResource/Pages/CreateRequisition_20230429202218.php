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
    protected function afterSave()
    {
        $phone
       $pendingSMS= new SMSController();
         $pendingSMS->sendSMS(
            Auth::user()->phone,
            'Your requisition has been submitted and pending. You will be notified of the next status update.'
         );
         return redirect()->route('requisitions.index');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
