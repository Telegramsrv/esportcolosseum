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
            'name' => 'sometimes|required|unique:teams,name'
        ];
        
        if($this->has('team_id')){
            $validation['team_id'] = 'required|custom_exists:teams,md5(id),true|team_players_not_playing_active_challenge';
        }
        return $validation;
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'team_id.team_players_not_playing_active_challenge' => 'Some player(s) of team is playing challenge.',
        ];
    }
}
