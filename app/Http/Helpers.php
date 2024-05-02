<?php

use App\Models\AdminSetting;
use App\Models\Category;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Cashier;

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
    function get_admin_setting($name)
    {
        $record = AdminSetting::where('name', $name)->first();
        if ($record) {
            return $record->value;
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
