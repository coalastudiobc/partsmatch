<?php

namespace App\Listeners;

use App\Models\Package;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use App\Models\PackagePaymentDetail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeWebhookEventListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        try {
            if ($event->payload['type'] === 'invoice.payment_succeeded') {
                Log::info('Event: ' . json_encode($event->payload));
                $json_string = file_get_contents('php://input');
                $responseArray = json_decode($json_string, true);
                $customerId = $responseArray['data']['object']['customer'];
                $stripe_productId = $responseArray['data']['object']['lines']['data'][0]['plan']['product'];
                $transcationId = $responseArray['data']['object']['lines']['data'][0]['subscription'];
                $plan_name = $responseArray['data']['object']['lines']['data'][0]['description'];
                $plan_type=$responseArray["data"]["object"]["lines"]["data"][0]['plan']['interval'];

                $userId = User::where("stripe_id", $customerId)->pluck('id')->first();
                $product_Id = Package::where("stripe_id", $stripe_productId)->pluck('id')->first();
                $plans_product_count = Package::where("stripe_id", $stripe_productId)->pluck('product_count')->first();

                if ($responseArray["data"]["object"]["amount_paid"] == 0) {
                    $status = "trailing";
                } else {
                    $status = "active";
                }
                PackagePaymentDetail::create([
                    'user_id' => $userId,
                    'plan_id' => $product_Id,
                    'plan_amount' => $responseArray["data"]["object"]["amount_paid"] / 100,
                    'plan_name' => $plan_name ,
                    'plan_type' => $plan_type ,
                    'transcation_id' => $transcationId,
                    'plan_product_count' => $plans_product_count,
                    'stripe_raw_data' => json_encode($responseArray),
                    'expire_at' => date('Y-m-d', $responseArray["data"]["object"]["lines"]["data"][0]['period']['end'])
                ]);
             
            } elseif ($event->payload['type'] === 'invoice.payment_failed') {
                $json_string = file_get_contents('php://input');
                $responseArray = json_decode($json_string, true);
                $customerId = $responseArray['data']['object']['customer'];
                $stripe_productId = $responseArray['data']['object']['lines']['data'][0]['plan']['product'];
                $transcationId = $responseArray['data']['object']['lines']['data'][0]['subscription'];
                $plan_name = $responseArray['data']['object']['lines']['data'][0]['description'];
                $plan_type=$responseArray["data"]["object"]["lines"]["data"][0]['plan']['interval'];

                $userId = User::where("stripe_id", $customerId)->pluck('id')->first();
                $product_Id = Package::where("stripe_id", $stripe_productId)->pluck('id')->first();
                $plans_product_count = Package::where("stripe_id", $stripe_productId)->pluck('product_count')->first();

               PackagePaymentDetail::create([
                    'user_id' => $userId,
                    'plan_id' => $product_Id,
                    'plan_amount' => $responseArray["data"]["object"]["amount_paid"] / 100,
                    'plan_name' => $plan_name ,
                    'plan_type' => $plan_type ,
                    'transcation_id' => $transcationId,
                    'plan_product_count' => $plans_product_count,
                    'stripe_raw_data' => json_encode($responseArray),
                ]);
            }
 
        } catch (\Exception $e) {
            Log::error('Stripe Webhook Error: ' . $e->getMessage());
        }
    }
}
