<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
        if (request()->method() == "POST") {

            $rules =  [
                'shipping_charge_type' => 'required',
            ];
            if (request()->ordercommission_type == 'Percentage') {
                $rules['shipping_charge'] = 'required | numeric | min:1 | max:99 | regex:/(\d+(?:\.\d+)?)/';
            } else {
                $rules['shipping_charge'] = 'required | numeric |min:1 | max:9999 | regex:/(\d+(?:\.\d+)?)/';
            }
            return $rules;
        }
        return [];
    }

    public function messages()
    {
        return [
            'shipping_charge_type.required' => "shipping charge type is required",
            'shipping_charge.required' => "shipping charge is required",
            'shipping_charge.min' => "shipping charge should be grater than 1",
            'shipping_charge.max' => "shipping charge should be less than 99",
            'shipping_charge.regex' => "only number allowed"
        ];
    }
}
