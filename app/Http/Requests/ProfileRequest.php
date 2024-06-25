<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required'],
            'image' => ['image', 'mimes:' . config('validation.php_profile_pic_mimes'), 'max:' . config('validation.php_profile_pic_size')],
            'industry_type' => ['required'],
            'address' => ['required'],
            'dealershipName' => ['required', 'string', 'regex:' . config('validation.name_regex'), 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customvalidation.user.name.required'),
            'email.required' => __('customvalidation.user.email.required'),
            'address.required' => __('customvalidation.user.address.required'),
            'phone_number.required' => __('customvalidation.user.phone_number.required'),
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The file must be of type: ' . config('validation.php_profile_pic_mimes'),
            'image.max' => 'The file may not be greater than' . config('validation.php_profile_pic_size'),
            'industry_type.required' => __('customvalidation.user.industry_type.required'),
            'dealershipName.required' => __('customvalidation.user.dealershipName.required'),
            'dealershipName.string' => __('customvalidation.user.dealershipName.string'),
            'dealershipName.nameRegex' => __('customvalidation.user.dealershipName.regex'),
            'dealershipName.max' => __('customvalidation.user.dealershipName.max'),

        ];
    }
}
