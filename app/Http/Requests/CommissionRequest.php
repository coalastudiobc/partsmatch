<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequest extends FormRequest
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
                'order_commission_type' => 'required',
            ];
            if (request()->ordercommission_type == 'Percentage') {
                $rules['order_commission'] = 'required | numeric | min:1 | max:99 | regex:/(\d+(?:\.\d+)?)/';
            } else {
                $rules['order_commission'] = 'required | numeric |min:1 | max:9999 | regex:/(\d+(?:\.\d+)?)/';
            }
            return $rules;
        }
        return [];
    }

    public function messages()
    {
        return [
            'order_commission_type.required' => "order commission type is required",
            'order_commission.required' => "order commission is required",
            'order_commission.min' => "order commission should be grater than 1",
            'order_commission.max' => "order commission should be less than 99",
            'order_commission.regex' => "only number allowed"
        ];
    }
}
