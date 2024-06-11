<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartsManagerRequest extends FormRequest
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
        $parameter = $this->route()->parameter('user');


        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required'],
            'password' =>  ['sometimes', 'nullable', 'between:8,32', 'same:confirm_password'],
            'confirm_password' => ['sometimes',  'nullable', 'between:8,32'],

        ];

        if (!$parameter) {
            $rules['image'] = ['required'];
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $rules['password'] =  ['required'];
            $rules['image'] = ['required', 'image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')];
            $rules['confirm_password'] = ['required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.user.name.required'),
            'email.required' => __('customvalidation.user.email.required'),
            'email.email' => __('customvalidation.user.email.email'),
            'phone_number.required' => __('customvalidation.user.phone_number.required'),
            'password.required' => __('customvalidation.user.password.required'),
            'confirm_password.required' => __('customvalidation.user.confirm_password.required'),
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The file must be of type: ' . config('validation.php_profile_pic_mimes'),
            'image.max' => 'The file may not be greater than' . config('validation.php_profile_pic_size'),
        ];
    }
}
