<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Game;
use App\Models\Notification;
use Route;
use Auth;
use GuzzleHttp\json_decode;

class PassDataToLayoutsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(['layouts.user.home', 'layouts.user.gamer-layout'], function($view)
        {
            $games = Game::where('status', 'Active')->get();
            $view->with(['games' => $games]);
        });
        
        view()->composer(['layouts.user.partials.add-coin', 'layouts.user.partials.withdraw-fund'], function($view)
        {
        	$options = getOptions();
        	$view->with(['options' => $options]);
        });
        
        view()->composer(['layouts.user.partials.notifications'], function($view)
        {
        	// $notifications = Notification::where('user_id', Auth::id())->get();
            $notifications = Auth::user()->notifications()->orderBy('id', 'desc')->get();
        	$view->with(['notifications' => $notifications]);
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
