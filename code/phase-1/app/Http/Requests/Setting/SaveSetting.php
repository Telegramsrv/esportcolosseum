<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SaveSetting extends FormRequest
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
    				'coins_per_dollar' 			=> 'sometimes|required|numeric|min:1',
    				'esc_challenge_interval_hrs'=> 'sometimes|required|numeric|min:1',
    			];
    			
    			break;
    			
    		case 'PUT':
    			
    		default: break;	
    	}
    	
    	return $validation;
    }
}
