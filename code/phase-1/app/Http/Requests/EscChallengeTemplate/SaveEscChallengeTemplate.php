<?php

namespace App\Http\Requests\EscChallengeTemplate;

use Illuminate\Foundation\Http\FormRequest;

class SaveEscChallengeTemplate extends FormRequest {
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
						'joining_coins' => 'required|numeric|max:100000',
						'winning_coins' => 'required|numeric|max:100000',
				];
				break;
			case 'PUT' :
				$validation = [ 
						'joining_coins' => 'required|numeric|max:100000',
						'winning_coins' => 'required|numeric|max:100000',
				];
			default :
				break;
		}
		
		return $validation;
	}
}
