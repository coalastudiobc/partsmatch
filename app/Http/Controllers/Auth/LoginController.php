<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Message;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        if (is_numeric($request->get('email'))) {
            return ['phone_number' => $request->get('email'), 'password' => $request->get('password')];
        }
        return [$this->username() => $request->get('email'), 'password' => $request->get('password')];
    }
    protected function authenticated(Request $request, $user)
    {
        if( is_null($user->email_verified_at) && is_null($user->working_for) )
        {
            Auth::logout();
            return redirect()->back()->with(['Error' => 'Please check the mail box and verify the email first to login.']);
            
        } else if($user->status == "INACTIVE")
        {
            Auth::logout();
            return redirect()->back()->with([ 'Error' => 'your account has been suspended by admin. Please contact to administrative.']);

        }else {
            return redirect($this->redirectTo);
        }
    }
}
