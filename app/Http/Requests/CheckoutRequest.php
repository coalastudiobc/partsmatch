<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'pin_code' => ['required', 'numeric'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'shiping_address1' => ['required'],
            'shiping_address2' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => __('customvalidation.user.first_name'),
            'last_name.required' => __('customvalidation.user.first_name'),
            'pin_code.required' => __('customvalidation.user.pin_code'),
            'country.required' => __('customvalidation.user.pin_code'),
            'state.required' => __('customvalidation.user.pin_code'),
            'city.required' => __('customvalidation.user.pin_code'),
            'shipping_address1.required' => __('customvalidation.user.pin_code'),
            'shipping_address2.required' => __('customvalidation.user.pin_code'),
        ];
    }
}
