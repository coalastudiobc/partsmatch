<?php

use App\Models\Cart;
use App\Models\Chat;
use App\Models\User;
use App\Models\CmsPage;
use App\Models\Category;
use App\Models\CartProduct;
use App\Models\AdminSetting;
use App\Models\OrderItem;
use App\Models\OrderParcels;
use App\Models\Product;
use App\Models\UserCommisionSetting;
use Laravel\Cashier\Cashier;
use App\Models\UserAddresses;
use App\Models\DealerPayout;
use App\Models\PackagePaymentDetail;
use App\Models\ShippingSetting;
use App\Models\ShippmentCreation;
use Laravel\Cashier\Subscription;
use App\Models\ShippoPurchasedLabel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


if (!function_exists('productByOrderItem')) {
    function productByOrderItem($product_id)
    {
        try {
            $isalready = Product::where('id', $product_id)->first();
            if ($isalready) {
                return  $isalready;
            }
            return false;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}

if (!function_exists('isFullFilledShippment')) {
    function isFullFilledShippment($order_id)
    {
        try {
            $isalready = ShippoPurchasedLabel::where('order_id', $order_id)->first();
            if ($isalready) {
                return  $isalready;
            }
            return false;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}

if (!function_exists('IspackageParcel')) {
    function IspackageParcel($orderItem_id, $product_id)
    {
        try {
            $isalready = OrderParcels::where('orderItem_id', $orderItem_id)->where('product_id', $product_id)->first();
            if ($isalready->status) {
                return  $isalready;
            }
            return false;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}

if (!function_exists('delveryAddress')) {
    function DelveryAddress()
    {
        try {
            $address = UserAddresses::where('id', auth()->user()->id)->where('type', 'Deliver')->first();
            if ($address) {
                return  $address;
            }
            return null;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}

if (!function_exists('getUserByParcelId')) {
    function getUserByParcelId($parcelId)
    {
        try {
            $product = ShippmentCreation::where('parcel_id', $parcelId)->first();
            if ($product) {
                return  $product->product_of;
            }
            return null;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}
if (!function_exists('getProductDetaiByParcelId')) {
    function getProductDetaiByParcelId($parcelId)
    {
        try {
            $product_id = ShippmentCreation::where('parcel_id', $parcelId)->first();
            if ($product_id) {
                return  $product_id->product;
            }
            return null;
        } catch (\Exception $e) {
            abort('403', $e->getMessage());
        }
    }
}


if (!function_exists('Auth')) {
    function Auth($id = null)
    {
        try {
            $id = auth()->user()->id;
            $userId = User::where('id', $id)->first();
            if ($userId) {
                return $userId;
            }
            return null;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}


if (!function_exists('getChatId')) {
    function getChatId()
    {
        try {
            $id = auth()->user()->id;
            $chatId = Chat::where('sender_id', $id)
                ->orWhere('reciever_id', $id)
                ->orderBy('last_msg_time', 'DESC')
                ->get();
            if ($chatId) {
                return $chatId;
            }
            return null;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}
if (!function_exists('check_chatId')) {
    function check_chatId($reciever_id = null)
    {
        try {
            $chatId = Chat::where(function ($q) use ($reciever_id) {
                $q->where([
                    ['sender_id', '=', auth()->user()->id],
                    ['reciever_id', '=', $reciever_id]
                ])->orwhere([
                    ['reciever_id', '=', auth()->user()->id],
                    ['sender_id', '=', $reciever_id]
                ]);
            })->first();
            if ($chatId) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}

if (!function_exists('getChat')) {
    function getChat($reciever_id = null)
    {
        try {
            $chatId = Chat::where(function ($q) use ($reciever_id) {
                $q->where([
                    ['sender_id', '=', auth()->user()->id],
                    ['reciever_id', '=', $reciever_id]
                ])->orwhere([
                    ['reciever_id', '=', auth()->user()->id],
                    ['sender_id', '=', $reciever_id]
                ]);
            })->first();
            if ($chatId) {
                return $chatId->chat_id;
            }
            return true;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}

if (!function_exists('encrypt_userdata')) {
    function encrypt_userdata(string $data)
    {
        try {
            $encryptData = Crypt::encryptString($data);
            return $encryptData;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}
if (!function_exists('decrypt_userdata')) {
    function decrypt_userdata(string $data)
    {
        try {
            $decryptData = Crypt::decryptString($data);
            return $decryptData;
        } catch (\Exception $e) {
            abort('403');
        }
    }
}




if (!function_exists('jsencode_userdata')) {
    function jsencode_userdata($data, string $encryptionMethod = null, string $secret = null)
    {
        if (empty($data)) {
            return "";
        }
        $encryptionMethod = config('app.encryptionMethod');
        $secret = config('app.secrect');
        try {
            $iv = substr($secret, 0, 16);
            $jsencodeUserdata = str_replace('/', '!', openssl_encrypt($data, $encryptionMethod, $secret, 0, $iv));
            $jsencodeUserdata = str_replace('+', '~', $jsencodeUserdata);
            return $jsencodeUserdata;
        } catch (\Exception $e) {
            return null;
        }
    }
}
if (!function_exists('jsdecode_userdata')) {
    function jsdecode_userdata($data, string $encryptionMethod = null, string $secret = null)
    {
        if (empty($data))
            return null;
        $encryptionMethod = config('app.encryptionMethod');
        $secret = config('app.secrect');
        try {
            $iv = substr($secret, 0, 16);
            $data = str_replace('!', '/', $data);
            $data = str_replace('~', '+', $data);
            $jsencodeUserdata = openssl_decrypt($data, $encryptionMethod, $secret, 0, $iv);
            return $jsencodeUserdata;
        } catch (\Exception $e) {
            return null;
        }
    }
}
if (!function_exists('store_image')) {
    function store_image($data, string $path)
    {
        if (empty($data)) {
            return null;
        }
        try {
            $file = $data->getClientOriginalName();
            $size = $data->getSize();
            $url = Storage::put($path, $data);
            return ['name' => $file, 'url' => $url, 'size' => $size / 1024];
        } catch (\Exception $e) {
            return null;
        }
    }
}
if (!function_exists('get_category')) {
    function get_category()
    {
        $record = Category::where('parent_id',   null)->get();

        return $record;
    }
}
if (!function_exists('get_subcategory')) {
    function get_subcategory($subcategory_id)
    {
        $record = Category::where('parent_id', $subcategory_id)->orderBy('name', 'ASC')->get();

        return $record;
    }
}
if (!function_exists('authCartProducts')) {
    function authCartProducts()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        if ($cart) {
            $cartItems = CartProduct::where('cart_id', $cart->id)->get()->pluck('product_id');
            $cart_products = $cartItems ? $cartItems->toArray()     : [];
            return $cart_products;
        }
        return [];
    }
}
// if (!function_exists('get_country')) {
//     function get_country()
//     {
//         return Country::get();
//     }
// }

// if (!function_exists('subscribed')) {
//     function subscribed($id)
//     {
//         $purchased = Auth::user()->subscriptions;
//         $purchasedPlan = $purchased->contains('name', $id);
//         $detail = Auth::user()->subscriptions()->where('name', $id)->first();
//         // dd($detail);
//         if ($purchasedPlan) {
//             return $detail;
//         }

//         return false;
//     }
// }
if (!function_exists('get_admin_setting')) {
    function get_admin_setting($id = null)
    {
        $record = ShippingSetting::where('id', $id)->first();
        if ($record) {
            return $record;
        }
        return null;
    }
}

if (!function_exists('get_cms')) {
    function get_cms()
    {
        $cms = CmsPage::where('status', 1)->get();
        return $cms;
    }
}
if (!function_exists('plan_validity')) {
    function plan_validity()
    {

        // $test = Auth::user()->subscription('trial_package')->onGracePeriod();
        // dd($test,'jg');
        $purchased = Auth::user()->subscriptions;
        $purchasedPlan = $purchased->where('stripe_status', 'active')->first();
        if ($purchasedPlan) {
            if (is_null($purchasedPlan->ends_at)) {

                return $purchasedPlan;
            } else {
                $daysLeft =  now()->diffInDays($purchasedPlan->ends_at, false);
                if ($daysLeft >= 0) {
                    return true;
                }
            }
        }

        return false;
    }

    if (!function_exists('get_categories')) {
        function get_categories($parentid)
        {
            // dd($parentid);
            $record = Category::where('id', $parentid)->first();
            if ($record) {
                return $record;
            }
            return null;
        }
    }
}
// if (!function_exists('stripe_details_validate')) {
//     function stripe_details_validate($key, $secret)
//     {
//         try {
//             config(['cashier.key' => $key]);
//             config(['cashier.secret' => $secret]);

//             return Cashier::stripe()->products->all(['limit' => 1]);
//         } catch (\Throwable $th) {

//             throw new Exception($th->getMessage());
//         }
//     }
// }

if (!function_exists('isFullFilledOrder')) {
    function isFullFilledOrder($order_id)
    {
        try {
            $all_products = OrderItem::where('order_id', $order_id)->pluck('id')->toArray();
            $isalready = OrderParcels::whereIn('orderItem_id', $all_products)->get();
            if($isalready && !count($isalready)){
                return  false;
            }
            $isalready = OrderParcels::whereIn('orderItem_id', $all_products)->where('status', 0)->first();
            if ($isalready) {
                return  false;
            } else {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('groupWith')) {
    function groupWith($orders)
    {
        try {
            $ids = OrderParcels::with('ordeItems')->whereIn('orderItem_id',$orders)->get()->groupBy('parcel_id');
            $groups = [];
            foreach($ids as $parcel){
                $items=[];
                foreach($parcel as $group){
                    array_push($items,$group->ordeItems);
                }
                array_push($groups,$items);
            }
            return $groups;
        } catch (\Exception $e) {
            return null;
        }
    }
}
if (!function_exists('viewGroups')) {
    function viewGroups($order)
    {
        try {
            $orderProducts = OrderItem::with('product', 'parcel')->where('order_id', $order->id)->get();
            $groups = groupWith($orderProducts[0]->getOrderIdsWithSameParcel());
            return $groups;
        } catch (\Exception $e) {
            return null;
        }
    }
}
if (!function_exists('checkForBuyButton')) {
    function checkForBuyButton($product)
    {
        try {
            $userId = auth()->id();
            $workingFor = optional(auth()->user())->working_for;
            $workingForInt = $workingFor !== null ? (int) $workingFor : null;

            $shouldShowButton =( $product->user_id !== $userId
                && $product->dealer_id !== $userId
                && ($product->dealer_id !== $workingForInt)
                && ($product->productOfDealer 
                    ? (int) optional($product->productOfDealer->first())->working_for !== $workingForInt
                    : $workingForInt === null));            
            return $shouldShowButton;
        } catch (\Exception $e) {
            // Log::error('Error in checkForBuyButton: ' . $e->getMessage());
            return false; 
        }
    }
}
if (!function_exists('calculatePayOuts')) {
    function calculatePayOuts($sellerId,$shipping,$cartAmnt)
    {
        try {
            $payout=0;
          $getUserCommission=  UserCommisionSetting::where('user_id',$sellerId)->first();
          $total=$shipping+$cartAmnt;
          if(is_null($getUserCommission))
            {
              $default_order_commission_type=AdminSetting::where('name','order_commission_type')->pluck('value')->first();
              $default_order_commission=AdminSetting::where('name','order_commission')->pluck('value')->first();
              if($default_order_commission_type == 'Percentage')
                {
                    $payout =  ($total* $default_order_commission)/100;
                }else
                {
                    $payout=$default_order_commission + $total;
                }
            }
            else{
                if ($getUserCommission->commision_type == 'Percentage')
                 {
                    $payout =  ($total* $getUserCommission->commision_value)/100;
                }else
                {
                    $payout=$getUserCommission->commision_value + $total;
                }
            }
            return $payout;
        } catch (\Exception $e) {
            // Log::error('Error in checkForBuyButton: ' . $e->getMessage());
            return false; 
        }
    }
}
if (!function_exists('isPaid')) {
    function isPaid($fulfilledOrder)
    {
        try {
          $getDealerPay =  DealerPayout::where('dealer_id',$fulfilledOrder->order_for)->where('order_id',$fulfilledOrder->id)->first();
          if(is_null($getDealerPay))
            {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            // Log::error('Error in checkForBuyButton: ' . $e->getMessage());
            return false; 
        }
    }
}
if (!function_exists('isPlanActive')) {
    function isPlanActive($plan)
    {
        try {
          $planDetails =  PackagePaymentDetail::where('user_id',auth()->id())->orderBy('created_at','Desc')->first();
          if(is_null($planDetails))
            {
                return false;
            }else{
                if($planDetails->plan_id ==$plan->id){
                    return true;
                }
                return false;
            }
            return false;
            // return $planDetails;
        } catch (\Exception $e) {
            // Log::error('Error in checkForBuyButton: ' . $e->getMessage());
            return false; 
        }
    }
}
if (!function_exists('isAlreadyCancelled')) {
    function isAlreadyCancelled($plan)
    {
        try {
            
            $subscription = Subscription::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->first();

            if ($subscription && !is_null($subscription->ends_at)) {
                // Check if the ends_at date is in the past (subscription has ended)
                
                // if ($subscription->ends_at->isPast()) {
                //     return true;
                // }
                if ($subscription->ends_at) {
                    return true;
                }
            }

            return false;
        } catch (\Exception $e) {
            // Log::error('Error in isAlreadyCancelled: ' . $e->getMessage());
            return false;
        }
    }
}


