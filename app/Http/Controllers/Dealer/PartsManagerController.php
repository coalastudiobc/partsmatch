<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartsManagerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartsManagerController extends Controller
{
    public function index()
    {
        $request = request();
        $users = User::where('working_for', auth()->user()->id)->Search()->orderBy('created_at', 'DESC')->Paginate(5);
        return view('dealer.parts_manager.index', compact('users'));
    }
    public function store(PartsManagerRequest $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'working_for' => auth()->user()->id,
            'image' => ['image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')],

        ];
        if ($request->image) {
            $image = store_image($request->image, 'profile_pictures');
            $user['profile_picture_url'] = $image['url'];
            $user['profile_picture_file'] = $image['name'];
        }

        $userdetails = User::create($user);
        $userdetails->assignRole('Manager');
        if ($request->role == "Basic") {
            $userdetails->givePermissionTo('role-view');
        }
        return redirect()->back()->with(['status' => 'success', 'message' => "created successfully"]);
    }

    public function edit(User $user)
    {
        return view('dealer.parts_manager.edit', compact('user'));
    }

    public function update(PartsManagerRequest $request, User $user)
    {
        try {
            $users = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'working_for' => auth()->user()->id,
            ];

            if ($request->password && $request->confirm_password) {
                if ($request->password === $request->confirm_password) {
                    $users = ['password' => Hash::make($request->password)];
                } else {
                    return redirect()->back()->with(['status' => 'error', 'message' => config('customvalidation.user.confirm_password.required')]);
                }
            }
            if ($request->editimage) {
                $image = store_image($request->editimage, 'profile_pictures');
                $users['profile_picture_url'] = $image['url'];
                $users['profile_picture_file'] = $image['name'];
            }

            $userdetails = $user->update($users);
            // $userdetails->assignRole('Manager');
            return redirect()->back()->with(['status' => 'success', 'message' => "User details update successfully"]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['status' => "success", 'message' => 'successfully deleted']);
    }
    public function getPartManagerDetail(User $user)
    {
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'role' => $user->role,
            'profile_pic_url' => $user->profile_picture_url,
        ];
        return response()->json(['data' => $data]);
    }
}
