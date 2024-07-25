<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Models\CartProduct;
use App\Models\AdminSetting;
use App\Models\BuyerAddress;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderPaymentController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->toArray());
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(config('services.Stripe.stripe_secret'));

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

            BuyerAddress::where('selected_method_id', $request->shipping_Method ?? 0)
                ->update(['order_id' => $order->id]);
            $shipping_add_row_id = session()->get('shipping_address_row_id');
            if ($shipping_add_row_id) {
                ShippingAddress::where('id', $shipping_add_row_id)->update(['order_id' => $order->id]);
                session()->forget('shipping_address_row_id');
            }
            DB::commit();
            toastr()->success('Order placed successfully.');
            return redirect()->route('Dealer.myorder.orderlist');
        } catch (Exception $e) {
            DB::rollback();
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
