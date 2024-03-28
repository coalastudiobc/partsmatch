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
                'ordercommission_type' => 'required',
            ];
            if (request()->ordercommission_type == 'Percentage') {
                $rules['ordercommission'] = 'required | numeric | min:1 | max:99 | regex:/(\d+(?:\.\d+)?)/';
            } else {
                $rules['ordercommission'] = 'required | numeric |min:1 | max:9999 | regex:/(\d+(?:\.\d+)?)/';
            }
            return $rules;
        }
        return [];
    }

    public function messages()
    {
        return [
            'ordercommission_type.required' => "order commission type is required",
            'ordercommission.required' => "order commission is required",
            'ordercommission.min' => "order commission should be grater than 1",
            'ordercommission.max' => "order commission should be less than 99",
            'ordercommission.regex' => "only number allowed"
        ];
    }
}
