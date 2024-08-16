<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetail;
use App\Models\User;
use App\Models\PostalCode;
use App\Notifications\UserRegistered;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
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

    public function search(Request $request)
    {
        $query = $request->get('q');
        $page = $request->get('page', 1);
        
        // Fetch data from the database
        $results = PostalCode::where('code', 'LIKE', "%{$query}%")
            ->paginate(10, ['id', 'code'], 'page', $page);

        // Format the results for select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->code
            ];
        });
        return response()->json([
            'results' => $formattedResults,
            'pagination' => [
                'more' => $results->hasMorePages()
            ]
        ]);
    }
   
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
       return Validator::make($data,[ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dealershipName' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => [
                'required',
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/\D/', '', $value);
                    if (strlen($digits) < 10 || $digits[0] === '0') {
                        return $fail('The ' . $attribute . ' must be a valid phone number and cannot start with zero.');
                    }
                    if (!preg_match('/^\(\d{3}\) \d{3}-\d{4}$/', $value)) {
                        return $fail('The ' . $attribute . ' must be a valid phone number in the format (XXX) XXX-XXXX.');
                    }
                }
            ],
            'address' => ['required', 'string'],
            'zipcode' => [
                'required',
                'string',
                Rule::exists('postal_codes', 'id')->where(function ($query) use ($data) {
                    return $query->where('id', $data['zipcode']);
                })
            ],
            'industry_type' => ['required', 'string'],
            'image' => ['required', 'mimes:jpeg,jpg,png'],
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
                'dealership_name' => $data['dealershipName'],
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
            $admin = User::Role('Administrator')->first();
            $user->notify(new VerificationEmail($user));
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
