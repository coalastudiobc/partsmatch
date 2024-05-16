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
        // dd(is_numeric($request->get('email')) , $this->username());
        if (is_numeric($request->get('email'))) {
            return ['phone_number' => $request->get('email'), 'password' => $request->get('password')];
        }
        return [$this->username() => $request->get('email'), 'password' => $request->get('password')];
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->status == "INACTIVE") {
            Auth::logout();
            return redirect()->back()->with(['status' => 'restricted', 'message' => 'your account has been suspended by admin']);
        } else {
            return redirect($this->redirectTo);
        }
    }
}
