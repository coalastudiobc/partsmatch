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
            'phone_number' => ['required', 'digits:10'],
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street1' => ['required', 'string', 'min:' . config('validation.address1_minlength'), 'max:' . config('validation.address1_maxlength')],
            'street2' => 'nullable|string|max:35',
            'description' => 'nullable|string|max:100',
            'pin_code' => ['required', 'digits_between:2,6'],
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

            'phone_number.required' => 'Phone number is required.',
            'phone_number.digits' => 'Phone number must be exactly 10 digits.',

            'country.required' => 'Country is required.',
            'state.required' => 'State is required.',
            'city.required' => 'City is required.',

            'street1.required' => 'Street address is required.',
            'street1.min' => 'Street address must be at least :min characters.',
            'street1.max' => 'Street address may not be greater than :max characters.',

            'street2.max' => 'Street address line 2 may not be greater than :max characters.',

            'description.max' => 'Description may not be greater than :max characters.',

            'pin_code.required' => 'Pin code is required.',
            'pin_code.digits_between' => 'Pin code must be between :min and :max digits.',
        ];
    }
}
