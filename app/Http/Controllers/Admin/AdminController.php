<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    
    public function store( Request $request, $id = null) {
           
        DB::beginTransaction();
        try {
            $id = jsdecode_userdata($id);
            $user = User::where('id',$id)->first();

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
            $url = route('admin.users.show',[jsencode_userdata($user->id)]);
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
}
