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
// after a requisition is created i want to send an sms to user using arkesel sms api. i have set up the api in .env file
    protected function afterCreate()
    {
        $url = 'https://api.arkesel.com/v1/sms/send';
        $data = array(
            'api_key' => env('ARKESEL_API_KEY'),
            'api_secret' => env('ARKESEL_API_SECRET'),
            'from' => env('ARKESEL_FROM'),
            'to' => env('ARKESEL_TO'),
            'text' => 'A requisition has been created by '.Auth::user()->name.' with requisition id '.$this->record->id.' and status '.$this->record->status,
        );
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r




protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }

}
