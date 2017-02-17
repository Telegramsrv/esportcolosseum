<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use DB;
Use Illuminate\Validation\Rule;

class AddPlayerInTeamRequest extends FormRequest
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
            'team_id' => 'required|custom_exists:teams,md5(id),true', 
            'player_id' => 'required|custom_exists:users,md5(id),true|player_not_playing_any_active_challenge'
        ];

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
            'player_id.required' => 'Player is required.',
            'player_id.custom_exists' => 'Please select valid player.',
            'player_id.not_playing_any_active_challenge' => 'Player is associated with other challenge.',
            'team_id.required' => 'Team is required.',
            'team_id.custom_exists'  => 'Please select valid team.',

        ];
    }
}
