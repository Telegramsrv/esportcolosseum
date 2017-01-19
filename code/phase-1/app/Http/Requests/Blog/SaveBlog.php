<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class SaveBlog extends FormRequest {
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
						'slug' => 'sometimes|required|unique:blogs,slug',
						'display_image' => 'required|image|max:2000',
						'banner_image' => 'required|image|max:5000' 
				];
				
				break;
			
			case 'PUT' :
				$validation = [
						'title' => 'sometimes|required|max:255',
						'slug' => 'sometimes|required|unique:blogs,id,'. $this->route()->getParameter('blogId'),
				];
				
				if($this->hasFile('display_image')) {
					$validation["display_image"] = 'required|image|max:2000';
				}
				
				if($this->hasFile('banner_image')) {
					$validation["banner_image"] = 'required|image|max:5000';
				}
			
			default :
				break;
		}
		
		return $validation;
	}
}
