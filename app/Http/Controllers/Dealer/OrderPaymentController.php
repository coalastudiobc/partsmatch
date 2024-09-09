<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Models\CartProduct;
use App\Models\AdminSetting;
use App\Models\BuyerAddress;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Notifications\OrderPlaced;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderPaymentController extends Controller
{
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(config('services.Stripe.stripe_secret'));

            $cart = Cart::where('user_id', auth()->user()->id)->first();
            $cartItems = CartProduct::with('product')->where('cart_id', $cart->id)->get();
            $stripeResponse = $this->StripePayment($request, $cart); //makng stripe payment for orders
            $shippment_details = ShippingSetting::find($request->shipping_Method);
            foreach ($cartItems as $item) {
                $order= $this->createOrder($cart,$item,$shippment_details,$stripeResponse,$request);
                $this->createOrderItem($item,$order);
            }
            $this->updateBuyerAddress($request, $cart, $order);
            $this->clearCart($cart);
            $this->updateShippingAddress($order);
            DB::commit();

        //   $orderDetail=  Order::find($order->id);
            // $this->notifyUsers($item,$order);
            toastr()->success('Order placed successfully.');
            $role = auth()->user()->getRoleNames()->first(); 
            return redirect()->route($role . '.myorder.orderlist');
        } catch (Exception $e) {
            DB::rollback();
            $role = auth()->user()->getRoleNames()->first(); 
            return redirect()->route($role . '.checkout.create')->with('error', $e->getMessage());
            // return redirect()->route()->with('error', $e->getMessage());
        }
    }
    private function StripePayment($request, $cart)
    { 
        try {
            $role = auth()->user()->getRoleNames()->first(); // Be cautious if a user has multiple roles
            $return_url = route($role . '.myorder.orderlist'); // Ensure this route exists
                return  PaymentIntent::create([
                    'amount' => floatval($request->total_payment) * 100, // amount in cents
                    'currency' => config('services.Stripe.currency'),//change according to country
                    'customer' => $request->stripeCustomer_id,
                    'payment_method' => $request->token,
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'description' => jsencode_userdata($cart->id),
                    'metadata' => [
                        'cart_id' => jsencode_userdata($cart->id), // Add your custom order ID as metadata
                    ],
                    'return_url' => $return_url
                ]);
            } catch (\Throwable $th) {
               throw new Exception("Error in stripe payment".$th->getMessage());
            }
    }
    private function createOrder($cart,$item,$shippment_details,$stripeResponse,$request)
    {
        try{
            $response= Order::UpdateOrCreate(
                ['cart_id' => $cart->id, 'order_for' => $item->product->user_id, 'user_id' => auth()->id()],
                [ 
                'status' => '1',
                'shipment_price' => ($shippment_details) ? $shippment_details->value : '0',
                'shippment_details' => ($shippment_details) ? $shippment_details : 'Free Delivery due to unavailable of shippment method for this price range.',
                'payment_raw_data' => $stripeResponse,
                'payment_method' => $request->token 
            ] );
            return $response;
        } catch (\Throwable $th) {
            throw new Exception("Error in createOrder function: ".$th->getMessage());   
         }
    }

    private function createOrderItem($item,$order)
    {
        try{
             OrderItem::create([
                'product_id' => $item->product_id,
                'order_id' => $order->id,
                'quantity' => $item->quantity,
                'product_price' => $item->product_price
            ]);
        } catch (\Throwable $th) {
            throw new Exception("Error in createOrderItem function : ".$th->getMessage());
        }
    }

    private function updateBuyerAddress($request, $cart, $order)
    {
        try{
            BuyerAddress::where('selected_method_id', $request->shipping_Method ?? 0)
            ->where('user_id',auth()->id())
            ->where('order_id',$cart->id)
            ->update(['order_id' => $order->id]);
        } catch (\Throwable $th) {
            throw new Exception("Error in updateBuyerAddress function: ".$th->getMessage());
         }
    }

    private function clearCart($cart)
    {
        try{
            CartProduct::where('cart_id', $cart->id)->delete();
            $cart->delete();
        } catch (\Throwable $th) {
            throw new Exception("Error in clearCart function: ".$th->getMessage());
         }
        
    }
     
    private function updateShippingAddress($order)
    {
        try{
            $shipping_add_row_id = session()->get('shipping_address_row_id');
            if ($shipping_add_row_id) {
                ShippingAddress::where('id', $shipping_add_row_id)->update(['order_id' => $order->id]);
                session()->forget('shipping_address_row_id');
            }
        } catch (\Throwable $th) {
            throw new Exception("Error in updateShippingAddress function: ".$th->getMessage());
         }
        
    }

    private function notifyUsers($item,$order)
    {
        try{
            $seller=User::find($item->product->user_id);
            if(!is_null($seller)){
                $seller->notify(new OrderPlaced($order));
            }
            auth()->user()->notify(new OrderPlaced($order));
            $admin = User::Role('Administrator')->first();
            if(!is_null($admin)){
                $admin->notify(new OrderPlaced($order));
            }
        } catch (\Throwable $th) {
            throw new Exception("Error in notifyUsers function :   ".$th->getMessage());
         }
        
    }   
}
