<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use App\User;

class PasswordRequest extends FormRequest
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
    	$validation = [];
    	switch ($this->method()){
    		case 'POST':
    			$validation = [
    				'old_password' => 'old_password:' . Auth::user()->password,
    				'password' => 'required|confirmed',
    				'password_confirmation' => 'required'
    			];
    			break;
    			
    		case 'PUT':
    			$validation = [
                    'old_password' => 'required|old_password:' . Auth::user()->password,
                    'password' => 'required|confirmed',
                    'password_confirmation' => 'required'
                ];
                break;
                
    		default: break;	
    	}
    	
    	return $validation;
        
    }
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
    	return [
    			'old_password' => 'Current password does not match.',
    	];
    }
    
}
