<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function changePassword(ChangePasswordRequest $request)
    {

        if ('POST' == $request->method()) {
            Auth::user()->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('admin.dashboard')->with(["status" => "success", "message" => "Password Updated Successfully"]);
        }
        return view('admin.change_password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
    
    public function redirectToDashboard()
    {
        if (Auth::user()->hasRole("Administrator")) {

            return redirect()->route('admin.dashboard');
        } else if (Auth::user()->hasRole("User")) {
            $subscriptions = Auth::user()->subscriptions;
            if (count($subscriptions)) {

                return redirect()->route('user.documents.all');
            } else {

                return redirect()->route('user.subscription.plans');
            }
        } else {
            return "ROLE NOT ASSIGNED";
        }
    }
}
