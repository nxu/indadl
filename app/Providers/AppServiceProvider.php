<?php

namespace App\Providers;

use App\AssetContentInliner;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('app', function ($view) {
            $inliner = app()->make(AssetContentInliner::class);
            $view->with([
                'css' => $inliner->getMixedAsset('css/app.css'),
                'js' => $inliner->getMixedAsset('js/app.js'),
            ]);
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
