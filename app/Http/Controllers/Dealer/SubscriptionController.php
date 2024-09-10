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
            return redirect()->back()->with(['error'=> $e->getMessage()]);   
        }
    }

    function purchaseSubscription(Request $request)
    {
        try {
            $plan_id = jsdecode_userdata($request->plan_id);
            $plan = Package::find($plan_id);
            if (!$plan) 
            {
                throw new \Exception('Selected plan did not found');
            }

            $subscription = $this->getActiveSubscription(); // Check if the user has an active subscription
            if ($subscription) {
                
                // If the user already has a subscription, upgrade it
                $subscription->swap($plan->stripe_price);
                if ($subscription && $subscription->canceled()) {
                    // Set the end date to the current date or any other logic you need
                    $subscription->update([
                        'ends_at' => null,
                    ]);
                }
            } else {
                 // If the user doesn't have a subscription, create a new one
                 $subscription = auth()->user()->newSubscription($plan->stripe_id, $plan->stripe_price)->create($request->token);

                // $subscription = $user->newSubscription($plan->stripe_id, $plan->stripe_price)
                //                     ->create($request->token, [
                //                         'email' => $user->email,
                //                         'ends_at' => Carbon::now()->$this->billingCycleLogic($plan),
                //                     ]);

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
    
    public function unsubscribe()
    {
        try {
            $user = auth()->user();
            
            $subscription = $this->getActiveSubscription();
            if (!$subscription || $subscription->ends_at) {
                return redirect()->route('Dealer.subscription.plan')->with('error', 'You have already canceled the plan.');
            }
            $subscription->cancel(); //cancel the plan and insert current date in ends_at column for latest one row of subscription
            return redirect()->route('Dealer.subscription.plan')->with('success', 'Subscription has been canceled successfully.');
        } catch (\Exception $e) {
            return redirect()->route('Dealer.subscription.plan')>with('error', $e->getMessage());
        }
    }

    public function storeData($subscription,$plan)
    {
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

    public function getActiveSubscription()
    {
        return auth()->user()->subscriptions()->active()->first();
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
   


 // public function billingCycleLogic($plan)
    // {
    //     try {
    //         $createdDate = Carbon::now();

    //         switch ($plan->billing_cycle) {
    //             case 'Monthly':
    //                 $expireDate = $createdDate->addMonth();
    //                 break;

    //             case 'Quarterly':
    //                 $expireDate = $createdDate->addMonths(3);
    //                 break;

    //             case 'Halfly':
    //                 $expireDate = $createdDate->addMonths(6);
    //                 break;

    //             case 'Yearly':
    //                 $expireDate = $createdDate->addYear(); // Carbon automatically handles leap years
    //                 break;

    //             default:
    //                 throw new \Exception('Invalid billing cycle type: ' . $plan->billing_cycle);
    //         }

    //         return $expireDate;

    //     } catch (\Exception $e) {
    //         throw new \Exception('Error in Adding Billing Cycle Logic: ' . $e->getMessage());
    //     }
    // }

}
