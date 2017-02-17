<?php

namespace App\Providers\Validations;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;
use App\User;
use App\Models\Challenge;

class ChallengeValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('player_not_playing_any_active_challenge', function ($attribute, $value, $parameters, $validator) {
            $valid = false;
            $user = User::where(DB::raw('md5(id)'), $value)->first();
            $activeChallenges = Challenge::myChallenges($user)->currentChallenges()->get();

            if($activeChallenges->count() > 0){
                $valid = false;
            }
            else{
                $valid = true;
            }

            return $valid;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
