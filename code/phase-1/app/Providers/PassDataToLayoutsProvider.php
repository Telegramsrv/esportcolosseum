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
            $games = Game::All();
            $view->with(['games' => $games]);
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
