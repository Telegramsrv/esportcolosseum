<?php

namespace App\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateOpenChallengeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($this->input('user_id') != md5($user->id)){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = array(
            'user_id' => 'required|custom_exists:users,md5(id),true|player_not_playing_any_active_challenge',
            'coins' => 'required|numeric|min:1|check_coins_balance|is_multiple_of_five',
            'region_id' => 'required|exists:regions,id',
            'challenge_type' => 'required',
            'challenge_sub_type' => 'required',
        );
        
        return $validations;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.player_not_playing_any_active_challenge' => 'You are associated with other challenge.',

        ];
    }
}
