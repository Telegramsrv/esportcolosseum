<?php

namespace App\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;

class CreateOpenChallengeRequest extends FormRequest
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
            'coins' => 'required|numeric|min:1|check_coins_balance|is_multiple_of_five',
            'region_id' => 'required|exists:regions,id',
            'challenge_type' => 'required',
            'challenge_sub_type' => 'required',
        );
        
        return $validations;
    }
}
