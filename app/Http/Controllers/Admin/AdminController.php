<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CommissionRequest;
use App\Models\AdminSetting;
use App\Models\Commission;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $dealers = User::role('Dealer')->search()->count();
        return view('admin.dashboard', compact('dealers'));
    }

    public function show()
    {
        $user = auth()->user();
        return view('admin.view', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('admin.update', compact('user'));
    }

    public function store(Request $request, $id = null)
    {

        DB::beginTransaction();
        try {
            $id = jsdecode_userdata($id);
            $user = User::where('id', $id)->first();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'country_id' => $request->country_id,
            ];

            if ($request->has('password') && !is_null($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            if ($request->has('profile_pic')) {
                $profile = store_image($request->file('profile_pic'), 'user/profilePicture');

                if ($profile != null) {
                    $data['profile_file'] = $profile['name'];
                    $data['profile_url'] = $profile['url'];
                }
            }
            if (!empty($user)) {
                if (!is_null($user->profile_url) && Storage::exists($user->profile_url) && $request->has('profile_pic')) {
                    Storage::delete($user->profile_url);
                }
                $user->update($data);
            } else {
                return response()->json([
                    'success'    =>  false,
                    'msg'       =>   "User not found"
                ], 200);
            }

            DB::commit();

            session()->flash('status', 'success');
            session()->flash('message', 'Data updated successfully');
            $url = route('admin.users.show', [jsencode_userdata($user->id)]);
            return response()->json([
                'success'    =>  true,
                'url'       =>   $url
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success'    =>  false,
                'msg'      =>  $e->getMessage()
            ]);
        }
    }

    public function settings()
    {
        return view('admin.settings');
    }
    public function stripeSettings(Request $request)
    {
        $request->validate([
            'stripe_key' => 'required',
            'secret_key' => 'required',
        ], [
            'stripe_key.required' => "stripe key is required",
            'secret_key.required' => "secret key is required",
        ]);

        AdminSetting::where('name', 'stripe_key')->update(['value' => $request->stripe_key]);
        AdminSetting::where('name', 'secret_key')->update(['value' => $request->secret_key]);
        AdminSetting::where('name', 'webhook_secret')->update(['value' => $request->webhook_secret]);

        session()->flash('status', 'success');
        session()->flash('message', 'Data updated successfully');
        return redirect()->route('admin.settings.view');
    }

    public function commission(CommissionRequest $request)
    {
        if ($request->method() == "POST") {
            AdminSetting::where('name', 'order_commission_type')->update(['value' => $request->order_commission_type]);
            AdminSetting::where('name', 'order_commission')->update(['value' => $request->order_commission]);


            session()->flash('status', 'success');
            session()->flash('message', 'Data updated successfully');
            return redirect()->route('admin.commission');
        }

        return view('admin.commission');
    }

    public function shipping(Request $request)
    {
        if ($request->method() == "POST") {
            AdminSetting::where('name', 'shipping_charge_type')->update(['value' => $request->shipping_charge_type]);
            AdminSetting::where('name', 'shipping_charge')->update(['value' => $request->shipping_charge]);


            session()->flash('status', 'success');
            session()->flash('message', 'Data updated successfully');
            return redirect()->route('admin.shipping');
        }

        return view('admin.shipping_price');
    }
    public function featured_list()
    {
        // $users = User::with('product', 'product.featuredProduct')->get();
        // $products = Product::with('featuredProduct', 'user', 'category', 'user.subscription')->get();
        // dd($products->toArray());
        $feature_products = FeaturedProduct::with('product', 'product.user.subscription', 'product.productImage')->get();
        // dd($feature_products->toArray());
        return view('admin.featured_list', compact('feature_products'));
    }
}
