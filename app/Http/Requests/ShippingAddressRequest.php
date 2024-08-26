<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SebastianBergmann\Type\TrueType;

class ShippingAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:' . config('validation.first_name_minlength'), 'max:' . config('validation.first_name_maxlength'), 'regex:' . config('validation.first_name_regex')],
            'last_name' => ['required', 'string', 'min:' . config('validation.last_name_minlength'), 'max:' . config('validation.last_name_maxlength'), 'regex:' . config('validation.last_name_regex')],
            'phone_number' => ['required',  function ($attribute, $value, $fail) {
                $digits = preg_replace('/\D/', '', $value);
                if (strlen($digits) < 10 || $digits[0] === '0') {
                    return $fail('The ' . $attribute . ' must be a valid phone number and cannot start with zero.');
                }
                if (!preg_match('/^\(\d{3}\) \d{3}-\d{4}$/', $value)) {
                    return $fail('The ' . $attribute . ' must be a valid phone number in the format (XXX) XXX-XXXX.');
                }
            }],
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street1' => ['required', 'string', 'min:' . config('validation.address1_minlength'), 'max:' . config('validation.address1_maxlength')],
            'street2' => 'nullable|string|max:35',
            'description' => 'nullable|string|max:100',
            'pin_code' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least :min characters.',
            'first_name.max' => 'First name may not be greater than :max characters.',
            'first_name.regex' => 'First name format is invalid.',

            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least :min characters.',
            'last_name.max' => 'Last name may not be greater than :max characters.',
            'last_name.regex' => 'Last name format is invalid.',

            'phone_number.required' => __('customvalidation.user.phone_number.required') ,
            'phone_number.digits' => 'Phone number must be exactly 10 digits.',

            'country.required' =>  __('customvalidation.user.country.required') ,
            'state.required' =>  __('customvalidation.user.state.required') ,
            'city.required' =>   __('customvalidation.user.city.required') ,

            'street1.required' => __('customvalidation.addresses.address1.required') ,
            'street1.min' =>  __('customvalidation.addresses.address1.min') ,
            'street1.max' =>  __('customvalidation.addresses.address1.max') ,

            'street2.max' => __('customvalidation.addresses.description.max') ,

            'description.max' => 'Description may not be greater than :max characters.',

            'pin_code.required' =>  __('customvalidation.user.pin_code.required') ,
            'pin_code.digits_between' =>  __('customvalidation.user.pin_code.minlength', ['min' => config('validation.pincode_maxlength'), 'max' => config('validation.pincode_minlength')]) ,
        ];
    }
}
