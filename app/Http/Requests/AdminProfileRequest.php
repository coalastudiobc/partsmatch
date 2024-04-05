<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
            'email' => ['required'],
            'phone_number' => ['numeric'],
            'password' => ['same:confirm_password'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('customvalidation.user.name.required'),
            'email.required' => __('customvalidation.user.email.required'),
        ];
    }
}
