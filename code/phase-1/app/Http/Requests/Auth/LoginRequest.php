<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        	'email' => 'required|email|exists:users,email,status,Active', 
        	'password' => 'required|min:6',
        ];
    }
    
    public function messages()
    {
    	return [
    		'email.exists' => 'Email does not exists.',
            'email.required' => 'Please enter your Email.',
            'email.email' => 'Please enter a valid Email.',
            'password.required' => 'Please enter your Password.'
    	];
    }
}
