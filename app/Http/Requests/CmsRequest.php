<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'content' => ['required'],
            'image' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('customvalidation.cms.name.required'),
            'content.required' => __('customvalidation.cms.content.required'),
            'image.required' => __('customvalidation.cms.image.required'),

        ];
    }
}
