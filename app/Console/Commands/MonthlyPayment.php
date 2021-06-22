<?php

namespace App\Console\Commands;

use App\Payment;
use Illuminate\Console\Command;

class MonthlyPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $payment = [
                            "amount" => 1,
                            "plan_id" => 1,
                            "card_number" => 1,
                            "cvc" => 1,
                            "month" => 1,
                            "year" => 1,
                        ];
                        Payment::AddPayment($payment, $plan->user_id);
        $plans = Payment::whereRaw('id in (select max(id) from payment_histories group by (user_id))')
            ->get();
        foreach ($plans as $plan) {
            if($plan->plan_id != 1){
                if(date('Y-m-d',strtotime('-30 days')) > date('Y-m-d',strtotime($plan->created_at))){
                    $result = Payment::payStripe(["card" => $plan->card_number,
                        "cvc" => $plan->cvc,
                        "month" => $plan->month,
                        "year" => $plan->year], $plan->plan->amount, "Registration Payment to " . config('app.name'), function () use ($plan) {
                        echo "now";
                        $payment = [
                            "amount" => $plan->plan->amount,
                            "plan_id" => $plan->plan->id,
                            "card_number" => $plan->card_number,
                            "cvc" => $plan->cvc,
                            "month" => $plan->month,
                            "year" => $plan->year,
                        ];
                        Payment::AddPayment($payment, $plan->user_id);
                    });

                }
            }
        }
    }
}
