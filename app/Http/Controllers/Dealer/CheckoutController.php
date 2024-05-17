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
        $carts = Cart::with('cart_product', 'cart_product.product')->where('user_id', $user->id)->get();

        if (!is_null($data)) {

            $country = Country::where('id', $data->country_id)->first();
            $state = State::where('id', $data->state_id)->first();
            $city = City::where('id', $data->city_id)->first();

            return view('dealer.checkout', compact('countries', 'intent', 'total_amount', 'country', 'state', 'city', 'data', 'stripeCustomer', 'carts'));
        }
        return view('dealer.checkout', compact('countries', 'intent', 'total_amount', 'stripeCustomer', 'carts'));
    }
    public function store(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $user =  auth()->user();

            $cart = Cart::where('user_id', auth()->user()->id)->first();
            $cartItems = CartProduct::with('product')->where('cart_id', $cart->id)->get();
            $intent = PaymentIntent::create([
                'amount' => floatval($request->total_amount) * 100, // amount in cents
                'currency' => 'usd',
                'customer' => $request->stripeCustomer_id,
                'payment_method' => $request->token,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => jsencode_userdata($cart->id),
                'metadata' => [
                    'cart_id' => jsencode_userdata($cart->id), // Add your custom order ID as metadata
                ],
                'return_url' => route('dealer.myorder.orderlist')
            ]);


            $shippment_price = AdminSetting::where('name', 'shipping_charge')->first();
            foreach ($cartItems as $item) {
                $order = Order::UpdateOrCreate(['cart_id' => $cart->id, 'order_for' => $item->product->user_id, 'user_id' => auth()->id()], [
                    'status' => '1',
                    'shipment_price' => $shippment_price->value,
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
            $shiping_address = [
                'order_id' => $order->id,
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

            // dd("herer", $cartItems);

            DB::commit();

            return redirect()->route('dealer.myorder.orderlist');
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function order()
    {
        $user = auth()->user();
        $data = $user->shippingAddress;
        // $orders = Order::with('orderItem')->where('user_id', auth()->id())->orderByDesc('id')->paginate(10);
        $orders =  Order::with('orderItem')->where('user_id', auth()->id())->paginate(10);

        // dd($order);
        return view('dealer.myorder.order_list', compact('orders'));
    }
}
