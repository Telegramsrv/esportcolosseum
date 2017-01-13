<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SaveUser extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$validation = [ ];
		switch ($this->method ()) {
			case 'POST' :
				$validation = [ 
						'title' => 'sometimes|required|max:255',
						'slug' => 'sometimes|required|email|unique:blogs,slug',
						'display_image' => 'sometimes|required|image|max:2000',
						'banner_image' => 'sometimes|required|image|max:5000' 
				];
				
				break;
			
			case 'PUT' :
			
			default :
				break;
		}
		
		return $validation;
	}
}
