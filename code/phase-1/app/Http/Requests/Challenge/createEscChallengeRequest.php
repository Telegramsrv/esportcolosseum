<?php

namespace App\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateEscChallengeRequest extends FormRequest
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
        $validations = array(
            //'user_id' => 'required|custom_exists:users,md5(id),true|player_not_playing_any_active_challenge',
            'time' => 'required|is_valid_esc_time' ,
            'date' => 'required|is_valid_esc_date:' . $this->input('time'),
            'coins' => 'required|numeric|min:1|check_coins_balance',
            'game_type' => 'required',
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
           // 'user_id.player_not_playing_any_active_challenge' => 'You are associated with other challenge.',
            'time.is_valid_esc_time' => 'Please select valid time.',
            'date.is_valid_esc_date' => 'You can not select past date.',

        ];
    }
}
