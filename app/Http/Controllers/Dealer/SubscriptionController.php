<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;
use stripe;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $plans = Package::where('status', '1')->get();
        $intent = $user->createSetupIntent();
        return view('dealer.subscription.plans', compact('plans', 'intent'));
    }

    function purchaseSubscription(Request $request)
    {
        // dd($request->toArray());
        try {
            $user = auth()->user();
            $plan_id = jsdecode_userdata($request->plan_id);
            $plan = Package::find($plan_id);
            $subscription = $user->newSubscription($plan->stripe_id, $plan->stripe_price)->create($request->token);
            // auth()->user()->notify(new SubscriptionPurchased());

            return redirect()->route('dealer.subscription.plan')->with(['status' => 'success', 'message' => 'Subscription purchased successfully']);
        } catch (Exception $e) {

            return redirect()->back()->with(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
