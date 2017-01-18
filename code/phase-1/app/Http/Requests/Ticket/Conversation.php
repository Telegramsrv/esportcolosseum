<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class Conversation extends FormRequest
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
    				'subject' 			=> 'sometimes|required',
    				'description' 		=> 'sometimes|required',
    			];
    			
    			break;
    			
    		case 'PUT':
    			
    		default: break;	
    	}
    	
    	return $validation;
    }
}
