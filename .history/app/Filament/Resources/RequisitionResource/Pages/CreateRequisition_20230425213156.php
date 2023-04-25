<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
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
// after a requisition is created i want to send an sms to user using 
    protected function afterCreate()
    {
        $user = Auth::user();
        $user->notify(new \App\Notifications\RequisitionCreated($this->record));
    }

protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }

}
