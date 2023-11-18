<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;

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
    public function boot(): void
    {
        view()->composer("*",function($view){

            $view->with('carts',Cart::orderBy('id','desc')->where('ip_address',request()->ip())->get());
        });
    }
}
