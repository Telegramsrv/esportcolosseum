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
						'name' => 'required|unique:game_master,id|max:255',
						'menu_image' => 'sometimes|required|image',
						'banner_image' => 'sometimes|required|image',
				];
				
				break;
			
			case 'PUT' :
				$validation = [
						'title' => 'sometimes|required|max:255',
						'name' => 'required||max:255|unique:game_master,id,'. $this->route()->getParameter('gameId'),
				];
				
				if($this->hasFile('menu_image')) {
					$validation["menu_image"] = 'required|image';
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
