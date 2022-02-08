<?php

namespace App\Providers;
use App\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $site_settings = SiteSetting::find(1);
//        $social_settings = SocialSetting::all();
        View::share([
            'site_settings' =>  $site_settings,
//            'social_settings' => $social_settings,
        ]);
    }
}
