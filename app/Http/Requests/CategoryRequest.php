<?php

namespace App\Http\Requests;

use App\Models\Category;

class CategoryRequest extends BaseFormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $parameter = $this->route()->parameter('id');

        $rules = [
            'name' => ['required', 'unique:categories,name', 'string', 'min:' . config('validation.name_minlength'), 'max:' . config('validation.name_maxlength'), 'regex:' . config('validation.name_regex')],
            // 'description' => ['required','string'],
        ];

        if (!empty($parameter)) {
            $parameter = jsdecode_userdata($parameter);
            $category = Category::where('id', $parameter)->first();
            $rules['name'][1] .= ',' . $category->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.category.name.required'),
            'name.unique' => __('customvalidation.category.name.unique'),
            'name.string' => __('customvalidation.category.name.string'),
            'name.regex' => __('customvalidation.category.name.regex'),
            'name.max' => __('customvalidation.category.name.max', ['min' => config('validation.name_minlength'), 'max' => config('validation.name_maxlength')]),
            'name.min' => __('customvalidation.category.name.min', ['min' => config('validation.name_minlength'), 'max' => config('validation.name_maxlength')]),

        ];
    }
}
