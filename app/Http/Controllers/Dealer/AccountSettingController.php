<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('dealer.account_setting', compact('user'));
    }
    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'industry_type' => $request->industry_type,
            'address' => $request->address,
        ];
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->has('image')) {
            $image = store_image($request->image, 'profile_pictures');

            $data['profile_picture_url'] = $image['url'];
            $data['profile_picture_file'] = $image['name'];
        }


        auth()->user()->update($data);

        return redirect()->back()->with(['status' => "success", "message" => 'Updated successfully']);
    }

    public function updatePassword(Request $request)
    {
        // dd($request->toArray());
        $currentPassword = $request->current_password;
        $user = auth()->user();

        if (!Hash::check($currentPassword, $user->password)) {
            return back()->with('error', __('password is incorrect'));
        }

        $newPassword = Hash::make($request->new_password);
        User::where('id', $user->id)->update(['password' => $newPassword]);
        return redirect()->back()->with(['status' => "success", "message" => 'Updated successfully']);
    }
}