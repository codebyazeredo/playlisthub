<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Spotify\SpotifyExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        Event::listen(SocialiteWasCalled::class, SpotifyExtendSocialite::class . '@handle');
    }

}
