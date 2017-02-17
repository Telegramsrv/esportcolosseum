<?php

namespace App\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Challenge;
use Auth;
use DB;

class ChangeChallengeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $challenge = Challenge::where(DB::raw('md5(id)'), $this->input('challenge_id'))->firstOrFail();
        if($user->id == $challenge->user_id || $user->id == $challenge->opponent_id){
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
        $validation = [
            'challenge_id' => 'required|custom_exists:challenges,md5(id),true',
            'challenge_status' => 'required',
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
            'challenge_id.custom_exists'  => 'Please select valid challenge.',
        ];
    }
}
