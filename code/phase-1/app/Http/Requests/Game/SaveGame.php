<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class SaveGame extends FormRequest {
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
						'name' => 'required|max:255',
						'slug' => 'required|unique:games,slug|max:255',
						'logo' => 'required|image',
						'image' => 'required|image',
						'banner_image' => 'required|image',
				];
				
				break;
			
			case 'PUT' :
				$validation = [
						'name' => 'required|max:255',
						'slug' => 'sometimes|required||max:255|unique:games,id,'. $this->route()->getParameter('gameId'),
				];
				
				if($this->hasFile('logo')) {
					$validation["logo"] = 'required|image';
				}
				
				if($this->hasFile('image')) {
					$validation["image"] = 'required|image';
				}
				
				if($this->hasFile('banner_image')) {
					$validation["banner_image"] = 'required|image';
				}
			
			default :
				break;
		}
		
		return $validation;
	}
}
