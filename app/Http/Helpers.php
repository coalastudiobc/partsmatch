<?php

use App\Models\AdminSetting;
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
    function get_admin_setting($name, $value = null)
    {
        $record = AdminSetting::where('name', $name)->first();
        if ($record && $value) {

            return $record->value;
        } else {
            return $record;
        }
        return null;
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
