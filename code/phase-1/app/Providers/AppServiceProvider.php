<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {    	
    		return Hash::check($value, current($parameters));
    	});

        Validator::extend('check_coins_balance', function ($attribute, $value, $parameters, $validator) {
            $valid = false;
            if(!empty($value)) {
                $user = Auth::user();
                if(!isset($user->userDetails()->first()->coins)){
                    return $valid;  
                }
                $coins = $user->userDetails()->first()->coins; 
                $valid = ($coins >= $value) ? true : false;
            }
            return $valid;
        });

        Validator::extend('is_multiple_of_five', function ($attribute, $value, $parameters, $validator) {
            $valid = false;
            if(!empty($value)) {
                if($value % 5 == 0){
                    $valid = true; 
                }
                else{
                    $valid = false;    
                }
            }
            return $valid;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
