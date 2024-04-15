<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetail;
use App\Models\User;
use App\Notifications\UserRegistered;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Notifications\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'unique:users', 'max:10', 'min:10'],
            'address' => ['required'],
            'zipcode' => ['required', 'min:6', 'max:6'],
            'industry_type' => ['required'],
            'image' => ['required', 'mimes:jpeg,png,jpg'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            $user = [
                'name' => $data['name'],
                'email' => $data['email'],
                'status' => 'INACTIVE',
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'],
                'address' => $data['address'],
                'zipcode' => $data['zipcode'],
                'industry_type' => $data['industry_type'],
                'email_verification_token' => str::random(50)

            ];
            if ($data['image']) {
                $image = store_image(request()->image, 'profile_pictures');
                $user['profile_picture_url'] = $image['url'];
                $user['profile_picture_file'] = $image['name'];
            }

            $userdetails = User::create($user);
            $userdetails->assignRole('Dealer');

            return $userdetails;
        } catch (\Exception $e) {

            return redirect()->back()->with(['status' => 'success', 'message' => $e->getMessage()]);
        }
    }


    protected function registered(Request $request, $user)
    {
        try {
            auth()->logout();
            $user->notify(new VerificationEmail($user));

            $admin = User::where('email', 'abhi@yopmail.com')->first();
            $admin->notify(new UserRegistered($user));

            return redirect()->route('login')->with('success', 'Registration successful. A confirmation email has been sent to ' . $user->email . '. Please verify to log in.');
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', $ex->getMessage());
        }
    }

    public function verifyEmail(Request $request, User $user, $token)
    {

        if ($token != $user->email_verification_token) {
            return redirect()->route('login')->with('error', 'Email verification token is invalid.');
        }
        $expiry  = Carbon::now()->subMinutes(60);

        if ($user->created_at <= $expiry) {
            return redirect()->route('login')->with('error', 'Password verification link expired');
        }
        try {
            User::where("id", $user->id)->update(["status" => "ACTIVE", "email_verified_at" => date('Y-m-d H:i:s'), 'email_verification_token' => null]);
        } catch (Exception $ex) {
            return redirect()->route('login')->with('error', $ex->getMessage());
        }

        return redirect()->route('login')->with('success', 'Email successfully verified.');
    }
}
