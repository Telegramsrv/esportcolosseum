<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InviteFriend extends FormRequest
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
				'friend_id' => 'sometimes|required|numeric',
				];
				break;
				 
			default: break;
		}
		 
		return $validation;
	}
}
