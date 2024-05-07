<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\AdminSetting;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    // public function __construct()
    // {
    //     $this->stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $this->stripeClient = new Stripe\StripeClient(env('STRIPE_SECRET'));
    // }
    public function state($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json(['title' => 'Success', 'data' => $states, 'message' => 'States retrieved successfully']);
    }
    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        // dd($cities);

        return response()->json(['title' => 'Success', 'data' => $cities, 'message' => 'Cities retrieved successfully']);
    }
    public function create()
    {
        $countries = Country::get();
        $total_amount = Cart::where('user_id', auth()->user()->id)->sum('amount');

        $user = auth()->user();
        $stripeCustomer = $user->createOrGetStripeCustomer();
        $intent = $user->createSetupIntent();
        $data = $user->shippingAddress;
        if (!is_null($data)) {

            $country = Country::where('id', $data->country_id)->first();
            $state = State::where('id', $data->state_id)->first();
            $city = City::where('id', $data->city_id)->first();

            return view('dealer.checkout', compact('countries', 'intent', 'total_amount', 'country', 'state', 'city', 'data', 'stripeCustomer'));
        }
        return view('dealer.checkout', compact('countries', 'intent', 'total_amount', 'stripeCustomer'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $user =  auth()->user();


            // dd('herere', $request);
            $carts = Cart::with('cart_product')->where('user_id', auth()->user()->id)->get();
            // dd('herere', $carts->toArray(), $request->toArray());
            $shippment_price = AdminSetting::where('name', 'shipping_charge')->first();
            if (isset(auth()->user()->shippingAddress)) {
                $shippingAdress =   ShippingAddress::where('id', auth()->user()->shippingAddress->id)->first();
                $shippingAdress->delete();
            }
            $shiping_address = [
                'user_id' => auth()->user()->id,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'name' => $request->first_name,
                'last_name' => $request->last_name,
                'post_code' => $request->pin_code,
                'address1' => $request->shiping_address1,
                'address2' => $request->shiping_address2
            ];
            ShippingAddress::create($shiping_address);
            $order = [
                'user_id' => auth()->user()->id,
                'status' => 1,
                'shipment_price' => $shippment_price->value,
                'total_amount' => $carts[0]->amount,
                'payment_method' => $request->token,
            ];
            $order = Order::create($order);

            foreach ($carts as $key => $cart) {
                $order_item = [
                    'product_id' => $cart->cart_product->product_id,
                    'order_id' => $order->id,
                    'quantity' => $cart->cart_product->quantity,
                    'product_price' => $cart->cart_product->product_price
                ];
                $product = Product::where('id', $cart->cart_product->product_id)->first();
                if ($product->stocks_avaliable > $cart->cart_product->quantity) {
                    $stockquantity = $product->stocks_avaliable - $cart->cart_product->quantity;
                    $product->update(['stocks_avaliable' => $stockquantity]);
                }
                OrderItem::create($order_item);

                CartProduct::where('id', $cart->cart_product->id)->delete();
                Cart::where('id', $cart->id)->delete();
            }


            $intent = PaymentIntent::create([
                'amount' => floatval($request->total_amount) * 100, // amount in cents
                'currency' => 'usd',
                'customer' => $request->stripeCustomer_id,
                'payment_method' => $request->token,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => jsencode_userdata($order->id),
                'metadata' => [
                    'order_id' => $order->id, // Add your custom order ID as metadata
                ],
                'return_url' => route('dealer.order.orderlist')
            ]);
            DB::commit();

            // $charge = Charge::create([
            //     'amount' => 1000, // amount in cents
            //     'currency' => 'usd',
            //     'source' => $request->token, // obtained with Stripe.js
            //     'description' => 'Example Charge',
            // ]);
            // $intent = PaymentIntent::create([
            //     'amount' => $request->total_amount, // amount in cents
            //     'currency' => 'usd',
            //     'source' => $request->token,
            //     'payment_method_types' => ['card'],
            //     // 'metadata' => [
            //     //     'order_id' => $order->id, // Add your custom order ID as metadata
            //     // ],
            // ]);
            // Create the charge with metadata
            // $charge = \Stripe\Charge::create([
            //     'amount' => $request->total_amount,
            //     'currency' => 'usd',
            //     'source' => $request->token, // Use a test token like 'tok_visa' for testing
            //     'description' => 'Payment for order',
            //     // 'metadata' => [
            //     //     'order_id' => $order->id, // Add your custom order ID as metadata
            //     // ],
            // ]);
            // dd($intent);
            return redirect()->route('dealer.order.orderlist');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function order()
    {
        $user = auth()->user();
        $data = $user->shippingAddress;
        $order_item = Orderitem::with('product', 'order')->whereRelation('order', 'orders.user_id', auth()->id())->orderByDesc('id')->get();
        // dd($order_item->toArray());
        return view('dealer.order.order_list', compact('order_item'));
    }
}
