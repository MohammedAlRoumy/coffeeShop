<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Cart;

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
        //
        Paginator::useBootstrap();

        View::composer('frontend.index', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
       // $this->bootSettings();
    }


   /* public function bootSettings(){
        foreach (Setting::all() as $setting){
            Config::set($setting->key,$setting->value);
        }
    }*/
}
