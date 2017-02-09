<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

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

        Validator::extend('custom_exists', function($attribute, $value, $parameters, $validator){
            $valid = false;
            $query = DB::table($parameters['0'])->select('*');
            if(isset($parameters[2]) && $parameters[2] == true){
                $query->where(DB::raw($parameters[1]), "=", $value);
            }
            else{
                $query->where($parameters[1], "=", $value);   
            }

            if($query->count() > 0){
                $valid = true;
            }
            else{
                $valid = false;   
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
