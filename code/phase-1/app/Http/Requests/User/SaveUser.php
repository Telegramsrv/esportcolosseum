<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SaveUser extends FormRequest
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
    				'email' 			=> 'sometimes|required|email|unique:users,email',
    				'user_image'		=> 'sometimes|required|image|max:2000',
    				'password' 			=> 'sometimes|required|max:255',
    				'first_name' 		=> 'sometimes|required|max:255',
    				'last_name' 		=> 'sometimes|required|max:255',
    				'gamer_name' 		=> 'sometimes|required|max:100',
    				'mobile_number' 	=> 'sometimes|required|numeric',
    				'address_1' 		=> 'sometimes|required|max:255',
    				'address_2' 		=> 'sometimes|required|max:255',
    				'pincode' 			=> 'sometimes|required|numeric',
    				'city' 				=> 'sometimes|required|max:255',
    				'state' 			=> 'sometimes|required|max:255',
    			];
    			
    			break;
    			
    		case 'PUT':
    			
    		default: break;	
    	}
    	
    	return $validation;
    }
}
