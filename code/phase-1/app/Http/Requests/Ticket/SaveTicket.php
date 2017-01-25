<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SaveTicket extends FormRequest
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
        if($roleName == "admin"){}

        $validation = [];
        switch ($roleName){
            case 'admin':
                switch ($this->method()){
                    case 'POST':
                        $validation = [
                            'status'    => 'sometimes|required',
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
                            'title'         => 'required|max:255',
                            'description'   => 'required',
                        ];
                        break;
                     case 'PUT':
                        $validation = [
                        	'description'   => 'required',
                        	];
                        	break;
                }
                break;
        }
    	
    	
    	return $validation;
    }
}
