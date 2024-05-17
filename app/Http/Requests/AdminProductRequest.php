<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
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
        if(request()->method() == 'POST'){
            return [
                'name'=> 'required',
                'category' => 'required',
                'subcategory' =>'required',
                'description' => 'required',
                'additional_details'=>'required',
                'other_specification' => 'required',
                'images'=> 'required',
                'stocks_avaliable'=> 'required',
                'price'=> 'required',
                'shipping_price'=> 'required',
                'car_years' => 'required',
                'car_makes' => 'required',
                'car_models' => 'required',
                'images'=>'required',
            ];
        } else {
            return [];
        }
    }
}
