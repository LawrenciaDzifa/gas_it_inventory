<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SMSController extends Controller
{
    public function sendSMS(String $message, string $phone)
    {

        $phone ;
        $message;
        $url = 'https://sms.arkesel.com/sms/api?action=send-sms&api_key=' . env('ARKESEL_API_KEY') . '&to=' . $phone .'&from=GASIT&sms='. '&sms=' . urlencode($message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}

