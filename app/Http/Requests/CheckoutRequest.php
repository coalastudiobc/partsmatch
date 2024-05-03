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
            'first_name.required' => __('customvalidation.user.name.required'),
            // 'last_name.required' => __('customvalidation.user.first_name'),
            'pin_code.required' => __('customvalidation.user.pin_code.required'),
            'country.required' => __('customvalidation.user.country.required'),
            'state.required' => __('customvalidation.user.state.required'),
            'city.required' => __('customvalidation.user.city.required'),
            'shipping_address1.required' => __('customvalidation.user.address.required'),
            'shipping_address2.required' => __('customvalidation.user.address.required'),
        ];
    }
}
