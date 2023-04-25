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
// after a requisition is created i want to send an sms to user using arkesel sms api. i have set up the api in the .env file
    protected function afterCreate()
    {
        $apiKey = env('ARKESL_SMS_API_KEY');
        $apiSecret = env('ARKESL_SMS_API_SECRET');
        $from = env('ARKESL_SMS_FROM');
        $to = env('ARKESL_SMS_TO');
        $message = env('ARKESL_SMS_MESSAGE');
        $url = "https://api.arkesel.com/v1/sms/send";
        $data = array(
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
            'from' => $from,
            'to' => $to,
            'text' => $message
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($server_output, true);
        if ($result['status'] == 'success') {
            echo "Message sent successfully";
        } else {
            echo "Message failed to send";
        }
    }

    




protected function getRedirectUrl(): string
    {
        return $this-> getResource()::getUrl('index');
    }

}
