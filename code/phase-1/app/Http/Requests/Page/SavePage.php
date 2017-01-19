<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class SavePage extends FormRequest
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
    				'title' 			=> 'sometimes|required|max:255',
    				'description' 		=> 'sometimes|required',
    			];
    			
    			break;
    			
    		case 'PUT':
    			
    		default: break;	
    	}
    	
    	return $validation;
    }
}
