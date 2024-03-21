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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required'],
            'password' => ['required', 'same:confirm_password'],
            'confirm_password' => ['required']
        ];
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
        ];
    }
}
