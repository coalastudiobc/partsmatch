<?php

namespace App\Http\Controllers\Dealer;

use stripe;
use Exception;
use Carbon\Carbon;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\PackagePaymentDetail;

class SubscriptionController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            $plans = Package::where('status', '1')->get();
            $intent = $user->createSetupIntent();
            return view('dealer.subscription.plans', compact('plans', 'intent'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['Error'=> $e->getMessage()]);   
        }
    }

    function purchaseSubscription(Request $request)
    {
        try {
            $user = auth()->user();
            $plan_id = jsdecode_userdata($request->plan_id);
            $plan = Package::find($plan_id);
            if (!$plan) 
            {
                throw new \Exception('Selected plan did not found : ' .$e->getMessage());
            }

            $subscription = $user->subscriptions()->active()->first(); // Check if the user has an active subscription
            if ($subscription) {
                 // If the user already has a subscription, upgrade it
                 $subscription->swap($plan->stripe_price);
            } else {
                 // If the user doesn't have a subscription, create a new one
                 $subscription = $user->newSubscription($plan->stripe_id, $plan->stripe_price)->create($request->token);
            }   

            if (!$subscription) 
            {
                throw new \Exception('Something went wrong in subscription creation : ' .$e->getMessage());
            }
                $this->storeData($subscription,$plan);

            return redirect()->route('Dealer.subscription.plan')->with(['status' => 'success', 'message' => 'Subscription purchased successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function storeData($subscription,$plan){
        try {
            if(!$subscription && !$plan)
            {
                throw new \Exception('Did not found Stripe subscription response OR selected plan : ' .$e->getMessage());
            }
            $storeData = PackagePaymentDetail::create([
                'user_id'=> auth()->id(),
                'plan_id'=>$plan->id,
                'plan_product_count' => $plan->product_count,
                'plan_name' => $plan->name,
                'plan_type' => $plan->billing_cycle,
                'plan_amount' => $plan->price,
                'transcation_id' => $subscription->stripe_id,
                'stripe_raw_data' => $subscription,
                'expire_at' => $this->billingCycleLogic($subscription,$plan),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong in Database storation : ' .$e->getMessage());
            
        }
    }
   

    public function billingCycleLogic($subscription,$plan)
    {
        try {
            if ($subscription) {
                $createdDate = $subscription->created_at->format('Y-m-d');
                switch ($plan->billing_cycle) {
                    case 'Monthly':
                        $expireDate = Carbon::parse($createdDate)->addMonth()->format('Y-m-d');
                        break;
            
                    case 'Quarterly':
                        $expireDate = Carbon::parse($createdDate)->addMonths(3)->format('Y-m-d');
                        break;
            
                    case 'Halfly':
                        $expireDate = Carbon::parse($createdDate)->addMonths(6)->format('Y-m-d');
                        break;
            
                    case 'Yearly':
                        $expireDate = Carbon::parse($createdDate)->addYear()->format('Y-m-d'); //carbon automatically handles the leap year cases
                        break;
            
                    default:
                    throw new \Exception('Invalid billing cycle type: ' . $plan->billing_cycle .' ' .$e->getMessage());
                }
                return $expireDate;
            } else {
                throw new \Exception('No Stripe subscription response found ' .$e->getMessage());
            }
        } catch (\Exception $e) {
            throw new \Exception(' in Adding billing Cycle Logic: ' .$e->getMessage());
        }   
    }
    
}
