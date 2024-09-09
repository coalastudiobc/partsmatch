<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ShippoTrait;
use App\Models\ShippoPurchasedLabel;
use App\Models\Order;
use App\Models\UserCommisionSetting;
use App\Models\AdminSetting;
use App\Models\DealerPayout;
use App\Models\UserBankDetail;
use Stripe\StripeClient;




class PayoutsController extends Controller
{     use ShippoTrait;

    public function index()
    {

        $fulfilledIds = ShippoPurchasedLabel::pluck('order_id');
        $fulfilledOrders = $fulfilledIds->isNotEmpty() ? Order::whereIn('id', $fulfilledIds)->latest()->paginate(__('pagination.admin_paginaion_number')) : Order::whereRaw('1 = 0')->paginate(__('pagination.admin_paginaion_number')); 
        return view('admin.payouts.index', compact('fulfilledOrders'));

    }
    public function payToDealer(Order $fulfilledOrder)
    {
        try {
          
        $dealerAmount= calculatePayOuts($fulfilledOrder->order_for,$fulfilledOrder->shipment_price,$fulfilledOrder->total_amount);
        $destination=  UserBankDetail::where('user_id', $fulfilledOrder->order_for)->firstOrFail();
        $payoutData =
        [
            "amount" => floatval($dealerAmount) * 100,
            "currency" => config('services.Stripe.currency'),
            "destination" => $destination->stripe_id,
            "metadata" => [
                "order_id" => $fulfilledOrder->id,
                "shippment_price" => $fulfilledOrder->shipment_price,
                "total_amount" => $fulfilledOrder->total_amount
                          ]
        ];
        \Stripe\Stripe::setApiKey(config('services.Stripe.stripe_secret'));

        $transfer = \Stripe\Transfer::create([
            // Your transfer data goes here
            $payoutData
        ]);
        
        $retaileramount = DealerPayout::create([
            "dealer_id" => $fulfilledOrder->order_for,
            "transaction_id" => $transfer['id'],
            "order_id" => $fulfilledOrder->id,
            'currency'=> config('services.Stripe.currency'),
            "amount" => $dealerAmount,
            "gateway_response" => str_replace("Stripe\Transfer JSON: ", "", $transfer)

        ]);
            return redirect()->route('admin.payouts.view')->with(['success'=>'Payment paid successfully']);
        } catch (\Exception $th) {
            return redirect()->route('admin.payouts.view')->with(['error'=>$th->getMessage()]);
        }
    }
    //    public  function calculatePayOuts($sellerId,$shipping,$cartAmnt)
    //     {
    //         try {
    //             $payout=0;
    //             $getUserCommission=  UserCommisionSetting::where('user_id',$sellerId)->first();
    //             $total=$shipping+$cartAmnt;
    //             if(is_null($getUserCommission))
    //                 {
    //                 $default_order_commission_type=AdminSetting::where('name','order_commission_type')->pluck('value')->first();
    //                 $default_order_commission=AdminSetting::where('name','order_commission')->pluck('value')->first();
    //                 if($default_order_commission_type == 'Percentage')
    //                     {
    //                         $payout =  ($total* $default_order_commission)/100;
    //                     }else
    //                     {
    //                         $payout=$default_order_commission + $total;
    //                     }
    //                 }
    //                 else{
    //                     if ($getUserCommission->commision_type == 'Percentage')
    //                     {
    //                         $payout =  ($total* $getUserCommission->commision_value)/100;
    //                     }else
    //                     {
    //                         $payout=$getUserCommission->commision_value + $total;
    //                     }
    //                 }
    //             return $payout;
    //         } catch (\Exception $e) {
    //             // Log::error('Error in checkForBuyButton: ' . $e->getMessage());
    //             return false; 
    //         }
    //     }

}
