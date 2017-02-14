<?php

namespace App\Http\Requests\Challenge;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Models\Challenge;
use DB;

class AcceptChallengeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // User cannot accept his own challenge
        $user = Auth::user();
        $challenge = Challenge::where(DB::raw('md5(id)'), $this->input('challenge_id'))->firstOrFail();
        if($user->id != $challenge->user_id){
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
            'challenge_id' => 'required|custom_exists:challenges,md5(id),true'
        ];

        return $validation;
    }
}
