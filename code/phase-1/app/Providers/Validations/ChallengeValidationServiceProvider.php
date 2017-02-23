<?php

namespace App\Providers\Validations;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;
use App\User;
use App\Models\Challenge;
use App\Models\Team;
use Carbon\Carbon;

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
            $valid = true;
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

        Validator::extend('team_players_not_playing_active_challenge', function ($attribute, $value, $parameters, $validator) {
            $valid = true;
            $team = Team::with('players')->where(DB::raw('md5(id)'), $value)->first();
            foreach($team->players as $player){
                if($player->id != $team->user_id){
                    $activeChallengesCount = Challenge::myChallenges($player)->currentChallenges()->count();
                    if($activeChallengesCount > 0){
                        $valid = false;
                        break;
                    }
                }
            }

            return $valid;
        });

        Validator::extend('is_valid_esc_time', function ($attribute, $value, $parameters, $validator) {
            return in_array($value, [0, 3, 6, 9, 12, 15, 18, 21]);
        });

        Validator::extend('is_valid_esc_date', function ($attribute, $value, $parameters, $validator) {
            $time = $parameters[0];
            $date = Carbon::parse($value);
            $date->addHour($time);
            $currentDate = Carbon::now();
            return $date >= $currentDate;
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
