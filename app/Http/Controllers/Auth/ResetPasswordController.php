<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\{Auth, DB, Hash};
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected function resetPassword($user, $password)
    {

        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        // event(new PasswordReset($user));
        Auth::logout();
        $this->redirectTo = 'login';

        return redirect($this->redirectTo)->with(['status' => true, 'message' => 'password updated successfully']);
    }
}
