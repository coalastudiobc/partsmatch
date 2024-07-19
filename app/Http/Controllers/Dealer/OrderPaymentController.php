<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Models\CartProduct;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ShippingSetting;

class OrderPaymentController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->toArray());
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(config('services.Stripe.stripe_secret'));
            $user =  auth()->user();

            $cart = Cart::where('user_id', auth()->user()->id)->first();
            $cartItems = CartProduct::with('product')->where('cart_id', $cart->id)->get();
            $stripeResponse = $this->StripePayment($request, $cart); //makng stripe payment for orders
            $shippment_details = ShippingSetting::find($request->shipping_Method);
            foreach ($cartItems as $item) {
                $order = Order::UpdateOrCreate(['cart_id' => $cart->id, 'order_for' => $item->product->user_id, 'user_id' => auth()->id()], [
                    'status' => '1',
                    'shipment_price' => ($shippment_details) ? $shippment_details->value : '0',
                    'shippment_details' => ($shippment_details) ? $shippment_details : 'Free Delivery due to unavailable of shippment method for this price range.',
                    'payment_raw_data' => $stripeResponse,
                    'payment_method' => $request->token
                ]);
                OrderItem::create([
                    'product_id' => $item->product_id,
                    'order_id' => $order->id,
                    'quantity' => $item->quantity,
                    'product_price' => $item->product_price
                ]);
            }
            CartProduct::where('cart_id', $cart->id)->delete();
            $cart->delete();

            if (isset(auth()->user()->shippingAddress)) {
                $shippingAdress =   ShippingAddress::where('id', auth()->user()->shippingAddress->id)->first();
                $shippingAdress->delete();
            }
            // ShippingAddress::create($shiping_address);
            DB::commit();
            return redirect()->route('Dealer.myorder.orderlist');
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    private function StripePayment($request, $cart)
    {
        return  PaymentIntent::create([
            'amount' => floatval($request->total_payment) * 100, // amount in cents
            'currency' => 'usd',
            'customer' => $request->stripeCustomer_id,
            'payment_method' => $request->token,
            'confirmation_method' => 'manual',
            'confirm' => true,
            'description' => jsencode_userdata($cart->id),
            'metadata' => [
                'cart_id' => jsencode_userdata($cart->id), // Add your custom order ID as metadata
            ],
            'return_url' => route('Dealer.myorder.orderlist')
        ]);
    }
}
