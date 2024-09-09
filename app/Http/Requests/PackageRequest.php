<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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

            'name' => ['required'],
            'price' => ['required'],
            'product_count' => ['required','integer'],
            'time_type' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.package.name.required'),
            'price.required' => __('customvalidation.packageprice.price.required'),
            'product_count.required' =>  __('customvalidation.package.product_count.required'),
            'product_count.integer'=>__('customvalidation.package.product_count.integer'),
            'time_type.required' => __('customvalidation.package.timetype.required'),
        ];
    }
}
