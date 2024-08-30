<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\OrderItem;
use Stripe\PaymentIntent;
use App\Models\CartProduct;
use App\Traits\ShippoTrait;
use App\Models\AdminSetting;
use App\Models\BuyerAddress;
use App\Http\Requests\ShippingAddressRequest;
use Illuminate\Http\Request;
use App\Models\UserAddresses;
use Illuminate\Support\Collection;
use App\Models\ShippingAddress;
use App\Models\ShippingSetting;
use App\Models\ShippmentCreation;
use App\Models\ProductParcelDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ShippoPurchasedLabel;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class CheckoutController extends Controller
{
    use ShippoTrait;
    // public function __construct()
    // {
    //     $this->stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $this->stripeClient = new Stripe\StripeClient(env('STRIPE_SECRET'));
    // }

    /*
        functionName : getPaymentPage
        createdDate :5-06-24
        purpose : to storing the data of selected rate for shippment  and get to payment page
        parameter : $request,
        */
    public function getPaymentPage(Request $request)
    {
        $selectedRateAmounts = [];
        $products = [];
        $totalShipping = 0;
        $selectedRateIds = $request->input('shipmentRates');
        // foreach ($selectedRateIds as $index => $rate_id) {
        //     $res = $this->checkRate_idInDb($rate_id);
        //     if (!$res || $res == false) {
        //         $rateDetails = $this->getRateDetails($rate_id);
        //         $this->storeSelectedRates($rateDetails);
        //         $res = $this->checkRate_idInDb($rate_id);
        //         foreach ($res->productsOfshippment as $key => $value) {
        //             dump($res, $res->productOfshippment, $value);
        //             $products[$res->shippment_id] = $value->product;
        //         }
        //         $selectedRateAmounts[$res->shippment_id] =  $this->getRateDetails($rate_id);
        //         // $selectedRateAmounts[] = $rateDetails->amount;
        //         // $saveShippmentIds[] = $rateDetails->shippment_id;
        //     } else {
        //         foreach ($res->productsOfshippment as $key => $value) {
        //             dump('value', $value);
        //             dump('$res->shippment_id', $res->shippment_id);

        //             $products[$res->shippment_id] = $value->product;
        //         }
        //         $selectedRateAmounts[$res->shippment_id] =  $this->getRateDetails($rate_id);
        //         $totolShipping += $res->amount;
        //     }
        // }
        foreach ($selectedRateIds as $index => $rate_id) {
            // Check if rate_id exists in the database
            $res = $this->checkRate_idInDb($rate_id);
            if (!$res || $res == false) {
                $rateDetails = $this->getRateDetails($rate_id);
                $this->storeSelectedRates($rateDetails);
                $res = $this->checkRate_idInDb($rate_id);
                $products[$res->shippment_id] = [];
                if ($res && $res->productsOfshippment) {
                    foreach ($res->productsOfshippment as $product) {
                        $products[$res->shippment_id][] = $product->product;
                    }
                }
                $selectedRateAmounts[$res->shippment_id] = $this->getRateDetails($rate_id);
                $totalShipping += $res->amount;
            } else {
                $products[$res->shippment_id] = [];
                if ($res->productsOfshippment) {
                    foreach ($res->productsOfshippment as $product) {
                        $products[$res->shippment_id][] = $product->product;
                    }
                }
                $selectedRateAmounts[$res->shippment_id] = $this->getRateDetails($rate_id);
                $totalShipping += $res->amount;
            }
        }

        // dd($products);
        $total_amount = Cart::where('user_id', auth()->user()->id)->sum('amount');

        $carts = Cart::with('cart_product', 'cart_product.product')->where('user_id', auth()->user()->id)->get();
        $allProductsOfCart = CartProduct::where('cart_id', $carts[0]->id)->get();
        return view('dealer.payment', compact('total_amount', 'allProductsOfCart', 'selectedRateAmounts', 'products', 'totalShipping'));
    }

    public function orderProductView(Order $order)
    {
        $orderItem = OrderItem::where('order_id', $order->id)->get();
        $role = auth()->user()->getRoleNames()->first();
        // if($role == 'User'){
            return view('dealer.myorder.view_public_product', compact('orderItem'));
        // }
        return view('dealer.myorder.view_products', compact('orderItem'));
    }


    public function getShippingMethods($country)
    {
        try {
            // dd($country);
            ($country == 'Canada') ? $country = 'Canada' : $country = 'United States';
            $total_amount = Cart::where('user_id', auth()->user()->id)->sum('amount');

            $integerAmount = (int) $total_amount;  // Convert to integer
            $TotalShippings = ShippingSetting::where('range_to', '>=', $integerAmount)->where('range_from', '<=', $integerAmount)->where('country', $country)->orderBy('value', 'desc')->get();
            if ($TotalShippings->isEmpty()) {
                throw new \Exception('No shipping settings found for the specified country.');
            }
            return response()->json(['status' => 'true', 'data' => $TotalShippings, 'message' => 'TotalShippings retrieved successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage()]);
        }
    }

    public function shippingRates(Request $request)
    {
        try {
            $selectedRateIds = $request->input('shipmentRates');
            // dd($request->toArray());
            $results = [];
            $responseOfrate = [];
            foreach ($selectedRateIds as $index => $rate_id) {
                $body = [
                    "rate" => $rate_id,
                    "async" => false,
                    "label_file_type" => "PDF_4x6",
                ];
                $response = $this->createTransaction($body);
                if ($response->object_status == 'SUCCESS') {
                    $results[$index] = $response->rate;
                    $rateDetails = $this->getRateDetails($rate_id);
                    $this->storeRateDetails($rateDetails, $response);
                }
            }
            dd($results);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function state($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json(['title' => 'Success', 'data' => $states, 'message' => 'States retrieved successfully']);
    }
    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get(['id','state_id','name',]);
        return response()->json(['title' => 'Success', 'data' => $cities, 'message' => 'Cities retrieved successfully']);
    }
    public function create()
    {
        try {
            $countries = Country::whereIn('name', ['Canada', 'United States'])->get();
            $total_amount = Cart::where('user_id', auth()->user()->id)->sum('amount');
            $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();

            $user = auth()->user();

            // $data = $user->shippingAddress;
            $carts = Cart::with('cart_product', 'cart_product.product')->where('user_id', $user->id)->first();
            $allProductsOfCart = CartProduct::with('product')->where('cart_id', $carts->id)->get();
            $isStockClear= $this->checkStockAvailForCart($allProductsOfCart,$carts);
            if(!$isStockClear){
                return redirect()->back()->with('error','Now stocks not available as much in your cart. Please refresh the page.');
            }
            $deliveryAddress = UserAddresses::where('user_id', auth()->user()->id)->where('type', 'Deliver')->first();
            // dd($deliveryAddress);
            // if (!is_null($data)) {

            //     $country = Country::where('id', $data->country_id)->first();
            //     $state = State::where('id', $data->state_id)->first();
            //     $city = City::where('id', $data->city_id)->first();

            //     return view('dealer.checkout', compact('countries', 'total_amount', 'country', 'state', 'city', 'data', 'carts', 'shippingCharge'));
            // }
            // if (is_null($deliveryAddress)) {
            //     return redirect()->back()->with('error', 'seller does not set picking address yet. please try again later');
            // }
            $integerAmount = (int) $total_amount;  // Convert to integer

            $TotalShippings = ShippingSetting::where('range_to', '>=', $integerAmount)->where('range_from', '<=', $integerAmount)->orderBy('value', 'desc')->get();
            return view('dealer.checkout', compact('countries', 'total_amount', 'carts', 'shippingCharge', 'allProductsOfCart', 'deliveryAddress', 'TotalShippings'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function store(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // $user =  auth()->user();

            $cart = Cart::where('user_id', auth()->user()->id)->first();
            $cartItems = CartProduct::with('product')->where('cart_id', $cart->id)->get();
            $intent = PaymentIntent::create([
                'amount' => floatval($request->total_amount) * 100, // amount in cents
                'currency' => config('services.Stripe.currency'),//change according to country
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
            DB::commit();
            return redirect()->route('Dealer.myorder.orderlist');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function order()
    {
        $user = auth()->user();
        $data = $user->shippingAddress;
        // $orders = Order::with('orderItem')->where('user_id', auth()->id())->orderByDesc('id')->paginate(10);
        $orders =  Order::with('orderItem')->where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(__('pagination.pagination_nuber'));
        $role = auth()->user()->getRoleNames()->first();
        // if($role == 'User'){
        //     return view('dealer.myorder.index', compact('orders'));
        // }
        return view('dealer.myorder.index', compact('orders'));
        // return view('dealer.myorder.order_list', compact('orders'));
    }
    public function to_address(Request $request)
    {   
        try {

            $responseInArray = $this->address($request);
            // dd($responseInArray);
            if ($responseInArray->object_state !== 'VALID') {

                throw new \Exception('Error in Api ' . $responseInArray->messages[0]->text);
            }
            $shippingAddress = [
                'user_id' => auth()->user()->id,
                'order_id' => $request->shipping_Method, //which shipping choose which is created by admin
                'address1' => $request->street1,
                'address2' => $request->street2 ?? null,
                'address_type' => $request->addressType ?? 'Office',
                'phone_number' => $request->phone_number,
                'post_code' => $request->pin_code,
                'name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'email' => auth()->user()->email,
            ];
            // $checkexistenceOfaddress = UserAddresses::where('user_id', auth()->user()->id)->where('type', 'Deliver')->first();
            // $flag = 1;
            // if ($flag || $checkexistenceOfaddress) {
            //     if ($checkexistenceOfaddress) {
            //         UserAddresses::where('user_id', auth()->user()->id)->where('type', 'Deliver')->delete();
            //         $toAddress = $responseInArray->object_id;
            //         $addressType = 'Deliver';
            //         $this->storeAddress($request, $addressType, $toAddress);
            //     }
            //     $flag = 0;
            // }




            // 'shipping_address_table_id' => $for_address->id,



            $current_shipping_address = ShippingAddress::create($shippingAddress);
            session()->put('shipping_address_row_id', $current_shipping_address->id);

            $cart = Cart::with('cart_product', 'cart_product.product')->where('user_id', auth()->user()->id)->first();
            $allProductsOfCart = CartProduct::with('product')->where('cart_id', $cart->id)->get();
            BuyerAddress::updateOrCreate([
                'user_id' => auth()->user()->id,
                'order_id' => $cart->id
            ], [
                'shippo_address_id' => $responseInArray->object_id,
                'selected_method_id' => $request->shipping_Method ?? 0,
            ]);
            $toAddress = $responseInArray->object_id;
            $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
            $intent = auth()->user()->createSetupIntent();

            $grandTotal = $request->grandTotal;
            $selectedShipping = ShippingSetting::find($request->shipping_Method);
            return view('dealer.payment', compact('allProductsOfCart', 'grandTotal', 'selectedShipping', 'stripeCustomer', 'intent'));
        } catch (\Exception $e) {
            return redirect()->back()->with('Error in shipping address: ', $e->getMessage());
        }
    }


    public function to_adddress(Request $request)
    {
        try {
            return redirect()->back()->with(['error' => 'some internal issues. Please try again later']);
            $response_in_array =  $this->address($request);
            $to_address = '';
            if ($response_in_array->object_state == "VALID") {
                $to_address = $response_in_array->object_id;
                $addresstype = 'Deliver';
                $this->storeAddress($request, $addresstype, $to_address);
                $carts = Cart::with('cart_product', 'cart_product.product')->where('user_id', auth()->user()->id)->get();
                $allProductsOfCart = CartProduct::where('cart_id', $carts[0]->id)->get();
                $parcelsIdInArray = [];
                $rateResults = [];
                $lastUserId = null;

                // $parcelsIdInOfDifferentUsers = 0;
                // $storeLastProductOfUser = 0;
                // foreach ($allProductsOfCart as $products) {
                //     if ($products->first) {
                //         $storeLastProductOfUser = $products->product_of;
                //     }
                //     $parcelDetails =  ProductParcelDetail::where('product_id', $products->product_id)->first();
                //     if ($storeLastProductOfUser == $products->product_of) {
                //         $parcelsIdInArray[] = $this->createParcel($parcelDetails);
                //         // $rateResults[$products->product_id] = $this->createShipment($to_address, $parcelsIdInArray);
                //     } else {
                //         $parcelsIdInOfDifferentUsers = $this->createParcel($parcelDetails);
                //         $rateResults[$products->product_id] = $this->createShipment($to_address, $parcelsIdInOfDifferentUsers);
                //     }
                //     $storeLastProductOfUser = $products->product_of;
                //     if ($products->last && !is_null($parcelsIdInArray)) {
                //         dd($parcelsIdInArray);
                //         $rateResults[$products->product_id] = $this->createShipment($to_address, $parcelsIdInArray);
                //     }
                // }

                // foreach ($allProductsOfCart as $products) {
                //     if ($lastUserId !== $products->product_of) {
                //         if (!empty($parcelsIdInArray)) {
                //             $rateResults[$lastUserId] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                //             $parcelsIdInArray = [];
                //         }
                //         $lastUserId = $products->product_of; // Update lastUserId to current user ID
                //     }
                //     $parcelDetails = ProductParcelDetail::where('product_id', $products->product_id)->first();
                //     $quantity = $products->quantity ?? 1; // Assume 1 if quantity is not defined
                //     for ($i = 0; $i < $quantity; $i++) {
                //         $parcelsIdInArray[] = $this->createParcel($parcelDetails, $products->product_id);
                //     }
                //     if ($products->last && !empty($parcelsIdInArray)) {
                //         $rateResults[$lastUserId] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                //     }
                // }
                // if (!empty($parcelsIdInArray)) {
                //     $rateResults[$lastUserId] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                // }


                // foreach ($allProductsOfCart as $key => $products) {
                //     if ($lastUserId !== $products->product_of) {
                //         if (!empty($parcelsIdInArray)) {
                //             if (array_key_exists($lastUserId, $rateResults)) {
                //                 $rateResults[$lastUserId][] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                //             } else {
                //                 $rateResults[$lastUserId] = [$this->createShipment($to_address, $parcelsIdInArray, $lastUserId)];
                //             }
                //             $parcelsIdInArray = []; // Reset parcels array
                //         }
                //         $lastUserId = $products->product_of;
                //     }

                //     $parcelDetails = ProductParcelDetail::where('product_id', $products->product_id)->first();
                //     $quantity = $products->quantity ?? 1; // Assume 1 if quantity is not defined

                //     for ($i = 0; $i < $quantity; $i++) {
                //         $parcelsIdInArray[] = $this->createParcel($parcelDetails, $products->product_id);
                //     }
                //     if ($key === count($allProductsOfCart) - 1 || $allProductsOfCart[$key + 1]->product_of !== $lastUserId) {
                //         if (array_key_exists($lastUserId, $rateResults)) {
                //             $rateResults[$lastUserId][] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                //         } else {
                //             $rateResults[$lastUserId] = [$this->createShipment($to_address, $parcelsIdInArray, $lastUserId)];
                //         }
                //         $parcelsIdInArray = [];
                //     }
                // }

                $usersProducts = [];

                // Step 1: Group products by user ID
                foreach ($allProductsOfCart as $products) {
                    $userId = $products->product_of;

                    // Initialize an array for the user if not already initialized
                    if (!isset($usersProducts[$userId])) {
                        $usersProducts[$userId] = [
                            'parcels' => [], // Array to store parcel IDs for the user
                            'lastUserId' => null, // Last user ID processed
                        ];
                    }

                    // Fetch parcel details for the product
                    $parcelDetails = ProductParcelDetail::where('product_id', $products->product_id)->first();
                    $quantity = $products->quantity ?? 1; // Assume 1 if quantity is not defined

                    // Create parcels for each product
                    for ($i = 0; $i < $quantity; $i++) {
                        $usersProducts[$userId]['parcels'][] = $this->createParcel($parcelDetails, $products->product_id);
                    }

                    // Update lastUserId for the user
                    $usersProducts[$userId]['lastUserId'] = $userId;
                }

                // Step 2: Create shipments for each user
                $rateResults = [];
                foreach ($usersProducts as $userId => $userData) {
                    $parcelsIdInArray = $userData['parcels'];
                    $lastUserId = $userData['lastUserId'];

                    // Create shipment for the user
                    $rateResults[$userId] = $this->createShipment($to_address, $parcelsIdInArray, $lastUserId);
                }

                // dd($rateResults);

                return view('dealer.rates', compact('rateResults'));
                dd($parcelsIdInArray, $rateResults);
            }
            $error_code = $response_in_array->messages[0]->code;
            // $error_type = $response_in_array->messages[0]->type;
            $error_text = $response_in_array->messages[0]->text;
            return redirect()->back()->with(['shippo' => 'error', 'code' => $error_code, 'text' => $error_text]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function createShipment($to_address, $parcelsIdInArray, $lastUserId)
    {
        try {
            // $carts = Cart::with('cart_product', 'cart_product.product')->where('user_id', auth()->user()->id)->get();
            // $allProductsOfCart = CartProduct::where('cart_id', $carts[0]->id)->get();
            // dd($carts, $allProductsOfCart);
            // $parcelsIdInArray = [];
            // $storeLastProductOfUser = 0;
            // foreach ($allProductsOfCart as $products) {
            //     $parcelDetails =  ProductParcelDetail::where('product_id', $products->id)->first();
            //     if ( $storeLastProductOfUser == $products->product_of) {
            //         $parcelsIdInArray[] = $this->createParcel($parcelDetails);
            //     }
            //     $storeLastProductOfUser = $products->product_of;
            // }
            // Product::where('id',auth)
            // dd($allProductsOfCart, $parcelsIdInArray);
            // "parcel" => ['e1c3f12dff52408683d891ccfb01d253'],

            $from_address = UserAddresses::where('user_id', $lastUserId)->where('type', 'Pickup')->pluck('shippo_address_id')->first();
            // $from_address = User::where('id', $lastUserId)->pluck('user_details_id')->first();
            $body = [
                "address_from" => $from_address,
                "address_to" => $to_address,
                "parcel" => $parcelsIdInArray,
                "object_purpose" => "PURCHASE",
                "async" => false,
                "shipment_date" => $this->getCurrentTimeFormatted()
            ];


            $guzzleRequest = new GuzzleRequest(
                'POST',
                'shipments/', // endpoint path relative to base_uri
                $this->headerApi(),
                json_encode($body)
            );

            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $res = $promise->wait();
            $response_in_array = json_decode($res);
            if ($response_in_array->object_status == "SUCCESS") {
                // $parcel_id_result = $response_in_array->object_id;
                $data = [
                    'user_id' => auth()->user()->id,
                    'address_to' => $to_address,
                    'address_from' => $from_address,
                    'shippment_id' => $response_in_array->object_id,
                    'shippment_date' => $this->getCurrentTimeFormatted(),
                ];
                $this->saveInDb($data, $parcelsIdInArray);
                return $response_in_array;
            }
        } catch (\Exception $e) {
            throw new \Exception('shipmeerror: ' . $e->getMessage());
        }
    }

    public function createParcel($parcelDetails, $current_product_id)
    {
        try {
            $body = [
                "length" => $parcelDetails->length,
                "width" => $parcelDetails->width,
                "height" => $parcelDetails->height,
                "distance_unit" => $parcelDetails->distance_unit,
                "weight" => $parcelDetails->weight,
                "mass_unit" => $parcelDetails->mass_unit,
            ];

            $guzzleRequest = new GuzzleRequest(
                'POST',
                'parcels/', // endpoint path relative to base_uri
                $this->headerApi(),
                json_encode($body)
            );
            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $res = $promise->wait();
            $response_in_array = json_decode($res);
            $parcel_id_result = '';
            if ($response_in_array->object_state == "VALID") {
                $parcel_id_result = $response_in_array->object_id;
                $data = [
                    'product_id' => $current_product_id,
                    'parcel_id' => $parcel_id_result,
                ];
                $response = $this->saveInDb($data);
                if ($response) {
                    return $parcel_id_result;
                }
            }
            $error_code = $response_in_array->messages[0]->code;
            // $error_type = $response_in_array->messages[0]->type;
            $error_text = $response_in_array->messages[0]->text;
            return redirect()->back()->with(['shippo' => 'error', 'code' => $error_code, 'text' => $error_text]);
        } catch (\Exception $e) {
            throw new \Exception('parcelError: ' . $e->getMessage());
        }
    }

    function getCurrentTimeFormatted()
    {
        return date('Y-m-d\TH:i');  //time format in "YYYY-MM-DDTHH:MM"
    }

    public function saveInDb($data, $parcelsIdInArray = null)
    {
        try {
            DB::beginTransaction();
            if ($parcelsIdInArray) {
                foreach ($parcelsIdInArray as $item) {
                    // dump($parcelsIdInArray, $item);
                    ShippmentCreation::where('parcel_id', $item)->update($data);
                }
            } else {
                // dump($data);
                ShippmentCreation::updateOrCreate($data); //update the where parcel id match which comes from shippment function
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('storing in database: ' . $e->getMessage());
        }
    }

    public function storeRateDetails($response, $masterResponse)
    {
        try {
            $data = [
                'rate_id' => $response->object_id,
                'shippment_id' => $response->shipment,
                'amount' => $response->amount,
                'currency' => $response->currency,
                'rate_provider' => $response->provider,
                'service_level_token' => $response->servicelevel_token,
                'days' => $response->days,
                'result' => $masterResponse->object_status,
                'master_rateId' => $masterResponse->rate,
                'tracking_number' => $masterResponse->tracking_number,
                'tracking_url' => $masterResponse->tracking_url_provider,
                'label_url' => $masterResponse->label_url,


            ];
            ShippoPurchasedLabel::create($data);
        } catch (\Exception $e) {
            throw new \Exception('storingRateDetail error: ' . $e->getMessage());
        }
    }

    public function storeSelectedRates($response)
    {
        try {
            $data = [
                'rate_id' => $response->object_id,
                'shippment_id' => $response->shipment,
                'amount' => $response->amount,
                'currency' => $response->currency,
                'rate_provider' => $response->provider,
                'service_level_token' => $response->servicelevel_token,
                'days' => $response->days,
            ];
            ShippoPurchasedLabel::create($data);
        } catch (\Exception $e) {
            throw new \Exception('storingRateDetail error: ' . $e->getMessage());
        }
    }
    /*
        functionName : checkingInDb
        createdDate :5-06-24
        purpose : to check into database for the same rate id is stored or not
        parameter : $rate_id
    */
    public function checkRate_idInDb($rate_id)
    {
        try {
            $result = ShippoPurchasedLabel::where('rate_id', $rate_id)->first();
            if ($result) {
                return $result;
            }
            return false;
        } catch (\Exception $e) {
            throw new \Exception('check rate in database error: ' . $e->getMessage());
        }
    }

    /*
        functionName : getProductByshipmentId
        createdDate :5-06-24
        purpose : to get the product of for selected shippment
        parameter : $shippment_id
    */
    public function getProductByshipmentId($shippment_id)
    {
    }
    
    public function checkStockAvailForCart($allProductsOfCart){
        try {
            $flag=false;
                foreach($allProductsOfCart as $key=>$product)
                {
                    if( $product->quantity <= $product->product->stocks_avaliable)
                    {
                      $flag=true;
                    }else{
                        $flag=false;
                      return $flag;
                    }
                }
            return $flag;
        } catch (\Throwable $th) {
           throw new Exception("Something went wrong in stocks of cart and stock availibility".$th->getMessage());
        }
    }
}
