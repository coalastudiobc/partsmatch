<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartsManagerController extends Controller
{
    public function index()
    {
        $users = User::where('working_for', auth()->user()->id)->get();
        return view('dealer.parts_manager.index', compact('users'));
    }
    public function store(Request $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'working_for' => auth()->user()->id,
        ];
        if ($request->image) {
            $image = store_image($request->image, 'profile_pictures');
            $user['profile_picture_url'] = $image['url'];
            $user['profile_picture_file'] = $image['name'];
        }

        $userdetails = User::create($user);
        $userdetails->assignRole('Manager');
        return redirect()->back()->with(['status' => 'success', 'message' => "created successfully"]);
    }

    public function edit(User $user)
    {
        return view('dealer.parts_manager.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $users = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'working_for' => auth()->user()->id,
        ];
        if ($request->image) {
            $image = store_image($request->image, 'profile_pictures');
            $users['profile_picture_url'] = $image['url'];
            $users['profile_picture_file'] = $image['name'];
        }

        $userdetails = $user->update($users);
        // $userdetails->assignRole('Manager');
        return redirect()->back()->with(['status' => 'success', 'message' => "created successfully"]);
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['status' => "success", 'message' => 'successfully deleted']);
    }
}
