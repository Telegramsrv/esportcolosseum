<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gamer_name' => 'required|max:255|unique:user_details,gamer_name',
            'email' => 'required|email|max:255|unique:users,email', 
        	'password' => 'required|min:6|confirmed|max:255',
            'CaptchaCode' => 'required|valid_captcha'
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => 'Confirm Password does not match',
            'CaptchaCode.required' => 'Captcha field is required.',
            'CaptchaCode.valid_captcha' => 'Captcha field is invalid.',
        ];
    }
}

