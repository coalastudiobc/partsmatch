<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartsManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $parameter = $this->route()->parameter('user');


        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')],
            'phone_number' =>
            [ 'required',
                function ($attribute,$value,$fail)
                {
                    $digits = preg_replace('/\D/', '', $value);
                    if (strlen($digits) < 10 || $digits[0] === '0') {
                        return $fail('The ' . $attribute . ' must be a valid phone number and cannot start with zero.');
                    }
                    if (!preg_match('/^\(\d{3}\) \d{3}-\d{4}$/', $value)) {
                        return $fail('The ' . $attribute . ' must be a valid phone number in the format (XXX) XXX-XXXX.');
                    }
                }
            ],
            'password' =>  ['sometimes', 'nullable', 'between:8,32', 'same:confirm_password'],
            'confirm_password' => ['sometimes',  'nullable', 'between:8,32'],

        ];
        //for user creating time
        if (!$parameter) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $rules['password'] =  ['required'];
            $rules['image'] = ['sometimes', 'nullable', 'image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')];
            $rules['confirm_password'] = ['required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.user.name.required'),
            'email.required' => __('customvalidation.user.email.required'),
            'email.email' => __('customvalidation.user.email.email'),
            'phone_number.required' => __('customvalidation.user.phone_number.required'),
            'password.required' => __('customvalidation.user.password.required'),
            'confirm_password.required' => __('customvalidation.user.confirm_password.required'),
            'image.required' => __('customvalidation.user.profile_pic.required'),
            'image.image' => __('customvalidation.user.profile_pic.file'),
            'image.mimes' => __('customvalidation.user.profile_pic.mimes'),
            'image.max' => __('customvalidation.user.profile_pic.size'),
        ];
    }
}
