<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {

        return view('admin.profile');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['confirmed'],
            'phone_number' => ['max:10', 'min:10'],
        ], [
            'name.required' => 'Please enter the name',
            'email.required' => 'Please enter the email',
        ]);
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

        return redirect()->back()->with(['status' => "success", "message" => 'Updated successfully']);
    }
}
