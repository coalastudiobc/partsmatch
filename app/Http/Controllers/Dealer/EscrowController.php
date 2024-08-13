<?php

namespace App\Http\Controllers\Dealer;

use Stripe\Stripe;
use Stripe\Account;
use Stripe\AccountLink;
use Illuminate\Http\Request;
use App\Models\UserBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EscrowController extends Controller
{
    
    public function redirectToStripe()
    {
        Stripe::setApiKey(config('services.Stripe.stripe_secret'));

        $account = Account::create([
            'type' => 'express',
        ]);

        auth()->user()->update(['stripe_account_id' => $account->id]);

        $accountLink = AccountLink::create([
            'account' => $account->id,
            'refresh_url' => route('Dealer.stripe.onboarding.refresh'),
            'return_url' => route('Dealer.stripe.onboarding.complete'),
            'type' => 'account_onboarding',
        ]);

        // Redirect to Stripe's hosted onboarding page
        return redirect($accountLink->url);
    } 
    public function refreshOnboarding()
    {
        return redirect()->route('Dealer.stripe.onboarding.create');
    }
 public function completeOnboarding()
    {
        $user = Auth::user();
        Stripe::setApiKey(config('services.Stripe.stripe_secret'));
 
        $account = Account::retrieve($user->stripe_account_id);
        // Check if the account is fully set up
        if ($account->details_submitted) {
            // Store the bank details in the database
            UserBankDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'stripe_id' => $user->stripe_account_id,
                    'country' => $account->country,
                    'raw_data' => json_encode($account),
                ]
            );
 
 
            session()->flash('showModal', true);
 
            return redirect()->route('Dealer.products.index')->with('success', 'Your account is created and your bank details have been stored.');
        } else {
            return redirect()->route('Dealer.products.index')->with('error', 'Your Stripe account setup is incomplete. Please complete the onboarding process.');
        }
    }
}
