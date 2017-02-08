<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
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
        $validation = [
            'challenge_id' => 'required',
        ];

        if($this->has('name')){
            $validation['name'] = 'required|unique:teams,name';
        }
        
        if($this->has('team_id')){
            $validation['team_id'] = 'required';
        }
        return $validation;
    }
}
