<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'category' => ['required', 'string',],
            'subcategory' => ['required'],
            'description' => ['required'],
            'stocks_avaliable' => ['required' ,'max:10'],
            'price' => ['required','regex:' . config('validation.product_price_regex'), 'max:255'],
            'part_number'=>['required', 'regex:'.config('validation.part_number_regex') ,'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.product.name.required'),
            'name.max' => __('customvalidation.product.name.max'),
            'category.required' => __('customvalidation.product.category.required'),
            'subcategory.required' => __('customvalidation.product.subcategory.required'),
            'description.required' => __('customvalidation.product.description.required'),
            'stocks_avaliable.required' => __('customvalidation.product.stocks_avaliable.required'),
            'stocks_avaliable.number' => __('customvalidation.product.stocks_avaliable.number'),
            'stocks_avaliable.max' => __('customvalidation.product.industry_type.required'),
            'price.required' => __('customvalidation.product.price.required'),
            'price.regex' => __('customvalidation.product.price.regex'),
            'price.max' => __('customvalidation.product.price.max'),
            'part_number.required' => __('customvalidation.product.part_number.required'),
            'part_number.regex' => __('customvalidation.product.part_number.regex'),
            'part_number.max' => __('customvalidation.product.part_number.max'),
        ];
    }
}
