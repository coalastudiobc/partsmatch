<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
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
    public function update(ProfileRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'industry_type' => $request->industry_type,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
        ];
        if ($request->has('image')) {
            $image = store_image($request->image, 'profile_pictures');

            $data['profile_picture_url'] = $image['url'];
            $data['profile_picture_file'] = $image['name'];
        }


        auth()->user()->update($data);

        return redirect()->back()->with(["message" => 'Updated successfully']);
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $old_password = $request->old_password;
        $user = auth()->user();

        if (!Hash::check($old_password, $user->password)) {
            return back()->with('error', __('password is incorrect'));
        }

        $newPassword = Hash::make($request->password);
        User::where('id', $user->id)->update(['password' => $newPassword]);
        return redirect()->back()->with(["message" => 'Updated successfully']);
    }
}
