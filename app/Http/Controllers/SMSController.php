<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SMSController extends Controller
{
    public function sendSMS(String $message, string $phone)
    {
        require __DIR__ . '/vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $apiKey = getenv('SMS_API_KEY');
        $phone;
        $message;
        $url = 'https://sms.arkesel.com/sms/api?action=send-sms&api_key= ' . $apiKey . '&to=' . $phone . '&from=GASIT&sms=' . '&sms=' . urlencode($message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}
