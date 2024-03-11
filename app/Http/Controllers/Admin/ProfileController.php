<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        
        return view('admin.profile');
    }
    public function update(Request $request)
    {
       dd('here',$request);

       $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number
       ];
       if($request->has('password')){
        
       }

    }
}
