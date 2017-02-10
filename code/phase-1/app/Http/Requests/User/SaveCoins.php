<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
    					$maxCoins = (isset(Auth::user()->userDetails->coins) ? Auth::user()->userDetails->coins : 0);
		    			$validation = [
		    				'coins' 			=> 'sometimes|required|integer|min:1',
		    				'withdrawFund' 		=> 'sometimes|required|integer|min:1|max:'.$maxCoins,
		    			];
		    			
		    			break;
		    			
		    		case 'PUT':
		    			
		    		default: break;
    			}
    			break;
    	}
    	 
    	return $validation;
    }
    
    public function messages()
    {
    	return [
    			'withdrawFund.required' => 'Coins field is invalid.',
    			'withdrawFund.integer'  => 'Coins field is invalid.',
    			'withdrawFund.min' 		=> 'Coins field is invalid.',
    			'withdrawFund.max' 		=> 'You dont have sufficient coins.',
    	];
    }
}
