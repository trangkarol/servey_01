<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SocialManager;
use Laravel\Socialite\Facades\Socialite;

class SocialServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $defer = true;

    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Laravel\Socialite\Factory', function ($app) {
            return new SocialManager($app);
        });
    }

    public function provider()
    {
        return ['Laravel\Socialite\Factory'];
    }
}
