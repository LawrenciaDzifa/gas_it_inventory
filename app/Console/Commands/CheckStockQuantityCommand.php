<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SMSController;
use App\Models\Stock;
use App\Models\User;

class CheckStockQuantityCommand extends Command
{
    protected $signature = 'check:stock';
    protected $description = 'Check stock quantity and send SMS if below 5';

    public function handle()
    {
        $stocks = Stock::where('quantity', '<', 5)->get();

        foreach ($stocks as $stock) {
            $message = "The stock quantity of " . $stock->item_name . " is below 5.";
            $phone =  User::where('role', 'admin')->first()->phone;

            $smsController = new SMSController();
            $smsController->sendSMS($message, $phone);

            $this->info("SMS sent for product $stock->item_name.");
        }
    }
}
