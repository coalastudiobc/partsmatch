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

            // $rules =  [
            //     'shipping_charge_type' => 'required',
            // ];
            $rules =  [
                'range_from' => ['required', 'numeric', 'min:0',],
                'range_to' => ['required', 'numeric'],
                'shipment_title' => ['required', 'string', 'min:3', 'max:50'],
                'country' => ['required'],
                'shipping_charge' => ['required', 'numeric', 'min:1', 'max:9999', 'regex:/(\d+(?:\.\d+)?)/'],
            ];
            // if (request()->shipping_charge_type == 'Percentage') {
            //     $rules['shipping_charge'] = 'required | numeric | min:1 | max:99 | regex:/(\d+(?:\.\d+)?)/';
            // } else {
            //     $rules['shipping_charge'] = 'required | numeric |min:1 | max:9999 | regex:/(\d+(?:\.\d+)?)/';
            // }
            return $rules;
        }
        return [];
    }

    public function messages()
    {
        $message = [
            'range_from.required' => 'Please enter the value of Range From.',
            'range_from.numeric' => 'Only numbers!',
            'range_from.min' => 'Number should be greater than or equal to zero.',
            'range_to.required' => 'Please enter the value of Range To.',
            'range_to.numeric' => 'Only numbers!',
            'range_to.greater_than' => 'Please enter a value greater than the specified range from.',
            'shipment_title.required' => 'The shipment title is required.',
            'shipment_title.min' => 'The shipment title must be at least :min characters.',
            'shipment_title.max' => 'The shipment title may not be greater than :max characters.',
            'country.required' => 'Please select a country.',
            'shipping_charge.required' => "shipping charge is required",
            'shipping_charge.min' => "shipping charge should be grater than 1",
            'shipping_charge.regex' => "only number allowed",
            'shipping_charge.max' => "shipping charge should be less than 9999",
        ];

        // if (request()->shipping_charge_type == 'Percentage') {
        //     $message['shipping_charge.max'] = "shipping charge should be less than 99";
        // } else {
        //     $message['shipping_charge.max'] = "shipping charge should be less than 9999";
        // }

        return $message;
    }
}
