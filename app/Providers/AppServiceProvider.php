<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TypeProduct;

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
        view()->composer("header", function ($view) {
            $loai_sp = TypeProduct::all();
            $view->with("loai_sp", $loai_sp);
        });
    }
}
