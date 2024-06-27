<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminProfileRequest;

class ProfileController extends Controller
{
    public function profile()
    {

        return view('admin.profile');
    }
    public function update(AdminProfileRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ];
            if ($request->has('password') && !is_null($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            if ($request->has('image')) {
                $image = store_image($request->image, 'profile_pictures');

                $data['profile_picture_url'] = $image['url'];
                $data['profile_picture_file'] = $image['name'];
            }
            auth()->user()->update($data);
            return redirect()->back()->with(['status' => "success", "message" => 'Profile Updated successfully.']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status' => "error", "message" => $th->getMessage()]);
        }
    }
}
