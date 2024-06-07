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
            'phone_number' => ['nullable', 'numeric'],
            'image' => ['image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')],
            'password' => ['same:confirm_password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.user.name.required'),
            'email.required' => __('customvalidation.user.email.required'),
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The file must be of type: ' . config('validation.php_profile_pic_mimes'),
            'image.max' => 'The file may not be greater than' . config('validation.php_profile_pic_size'),
        ];
    }
}
