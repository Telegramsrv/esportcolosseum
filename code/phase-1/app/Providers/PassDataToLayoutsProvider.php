<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Game;
use Route;

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
        
        view()->composer(['layouts.user.partials.add-coin'], function($view)
        {
        	$options = getOptions();
        	$view->with(['options' => $options]);
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
