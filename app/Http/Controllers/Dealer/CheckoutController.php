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
use Illuminate\Http\Request;
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
        $total_amount = Cart::sum('amount');
        $user = auth()->user();
        $intent = $user->createSetupIntent();

        $data = $user->shippingAddress;
        if (!is_null($data)) {

            $country = Country::where('id', $data->country_id)->first();
            $state = State::where('id', $data->state_id)->first();
            $city = City::where('id', $data->city_id)->first();

            return view('dealer.checkout', compact('countries', 'intent', 'total_amount', 'country', 'state', 'city', 'data'));
        }
        return view('dealer.checkout', compact('countries', 'intent', 'total_amount'));
    }
    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

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
            OrderItem::create($order_item);
        }

        $user =  auth()->user();
        $intent = PaymentIntent::create([
            'amount' => floatval($request->total_amount) * 100, // amount in cents
            'currency' => 'usd',
            'payment_method' => $request->token,
            'confirmation_method' => 'manual',
            'customer' => $user->stripe_id,
            'confirm' => true,
            'description' => jsencode_userdata($order->id),
            'metadata' => [
                'order_id' => $order->id, // Add your custom order ID as metadata
            ],
            'return_url' => route('dealer.partsmanager.index')
        ]);

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
        return redirect()->route('dealer.partsmanager.index');
    }

    public function order()
    {
        $user = auth()->user();
        $data = $user->shippingAddress;
        $order_item = Orderitem::with('product', 'order')->get();
        // dd($order_item->toArray());
        return view('dealer.order.order_list', compact('order_item'));
    }
}
