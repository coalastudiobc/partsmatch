<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Models\Product;
use App\Models\Commission;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserCommisionSetting;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShippingRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommissionRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

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
    public function commisionAdd(CommissionRequest $request, $user_id = null)
    {
        try {
            $get_dealer_id =  jsdecode_userdata($user_id);

            $data = [
                'user_id' => $get_dealer_id,
                'commision_type' => $request->order_commission_type,
                'commision_value' => $request->order_commission,
            ];
            $message = '';
            if (UserCommisionSetting::where('user_id', $get_dealer_id)->exists()) {
                UserCommisionSetting::where('user_id', $get_dealer_id)->update($data);
                $message = "Commision updated  successfully";
            } else {
                UserCommisionSetting::create($data);
                $message = "Commision created successfully";
            }
            session()->flash('status', 'success');
            session()->flash('message', $message);
            // Session::flash('toast_success', 'Your success message here');
            return redirect()->route('admin.dealers.all');
        } catch (\Throwable $e) {
            session()->flash('status', 'error');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }
    public function commission(CommissionRequest $request, $dealer_id = null)
    {
        if ($request->method() == "POST") {
            AdminSetting::where('name', 'order_commission_type')->update(['value' => $request->order_commission_type]);
            AdminSetting::where('name', 'order_commission')->update(['value' => $request->order_commission]);
            // UserCommisionSetting::
            session()->flash('status', 'success');
            session()->flash('message', 'Data updated successfully');
            return redirect()->route('admin.commission');
        }
        if ($dealer_id) {
            $get_dealer_id =  jsdecode_userdata($dealer_id);
            $user =  User::where('id', $get_dealer_id)->first();
            $username = $user->name;
            return view('admin.commission', compact('user', 'username'));
        }
        return view('admin.commission');
    }

    public function shipping(ShippingRequest $request)
    {
        if ($request->method() == "POST") {
            try {
                $data = [
                    'range_from' => $request->range_from,
                    'range_to' => $request->range_to,
                    'type' => $request->shipping_charge_type,
                    'value' => $request->shipping_charge,
                ];
                // $has_range_from = ShippingSetting::whereBetween('range_from', [$request->range_from, $request->range_to])->get();
                // if ($has_range_from->toArray()) {
                //     $has_range_to = ShippingSetting::whereBetween('range_to', [$request->range_from, $request->range_to])->get();
                //     if ($has_range_to->toArray()) {
                //         session()->flash('status', 'error');
                //         session()->flash('message', 'you can');
                //         return redirect()->back();
                //     } else {
                ShippingSetting::create($data);
                //     }
                // }

                session()->flash('status', 'success');
                session()->flash('message', 'Data updated successfully');
                return redirect()->route('admin.shipping.view');
            } catch (\Throwable $e) {
                session()->flash('status', 'error');
                session()->flash('message', $e->getMessage());
                return redirect()->back();
            }
        } else {
            $shipping_details = ShippingSetting::orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('admin.shipping_setting.index', compact('shipping_details'));
    }
    public function shippingEdit(ShippingRequest $request, $shipping_id)
    {
        if ($request->method() == "POST") {
            try {
                $data = [
                    'range_from' => $request->range_from,
                    'range_to' => $request->range_to,
                    'type' => $request->shipping_charge_type,
                    'value' => $request->shipping_charge,
                ];
                $id = jsdecode_userdata($shipping_id);
                $editrow =  ShippingSetting::where('id', $id)->first();
                $editrow->update($data);
                session()->flash('status', 'success');
                session()->flash('message', 'Data updated successfully');
                return redirect()->route('admin.shipping');
            } catch (\Throwable $e) {
                session()->flash('status', 'error');
                session()->flash('message', $e->getMessage());
                return redirect()->route('admin.shipping.view');
            }
        } else {
            $id = jsdecode_userdata($shipping_id);
            $data =  ShippingSetting::where('id', $id)->first();
            return view('admin.shipping_setting.add', compact('data'));
        }
    }
    public function shippingAdd()
    {
        return view('admin.shipping_setting.add');
    }

    public function shippingDestroy($shipping_id)
    {
        $id = jsdecode_userdata($shipping_id);
        ShippingSetting::find($id)->delete();
        session()->flash('status', 'success');
        session()->flash('message', 'Data deleted successfully');
        return redirect()->back();
    }

    public function featured_list()
    {
        // $users = User::with('product', 'product.featuredProduct')->get();
        // $products = Product::with('featuredProduct', 'user', 'category', 'user.subscription')->get();

        $feature_products = FeaturedProduct::with('product', 'product.user.subscription', 'product.productImage')->get();
        return view('admin.featured_list', compact('feature_products'));
    }
}
