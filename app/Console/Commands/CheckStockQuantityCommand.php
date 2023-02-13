<?php

namespace App\Console\Commands;

use App\Http\Controllers\SMSController;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CheckStockQuantityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:stock-quantity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check stock quantity every 5 minutes and send sms to admin if quantity is less than 5';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stocks = Stock::all();
        foreach ($stocks as $stock) {
            if ($stock->quantity < 5) {
                $message = "Stock for " . $stock->item_name . " is less than 5. Please restock.";
                $user = User::where('role', 1)->get();
                if ($user != null) {
                    $phone = $user->role->admin->phone;
                    $sms = new SMSController();
                    $sms->sendSms($message, $phone);
                }
            }
            \Log::info("message sent");
        }
    }
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command(CheckStockQuantityCommand::class)->everyFiveMinutes();
    // }
}
