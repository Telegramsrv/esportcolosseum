<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SaveCoins extends FormRequest
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
    	$roleName = getRole('name');
    	$validation = [];
    	
    	switch ($roleName){
    		case 'admin':
    			switch ($this->method()){
    				case 'POST':
		    			$validation = [
		    				'coins' 			=> 'sometimes|required|numeric',
		    			];
		    			
		    			break;
		    			
		    		case 'PUT':
		    			
		    		default: break;
    			}
    			break;
    		case 'user':
    			switch ($this->method()){
    				case 'POST':
		    			$validation = [
		    				'coins' 			=> 'sometimes|required|numeric|min:1',
		    			];
		    			
		    			break;
		    			
		    		case 'PUT':
		    			
		    		default: break;
    			}
    			break;
    	}
    	 
    	return $validation;
    }
}
