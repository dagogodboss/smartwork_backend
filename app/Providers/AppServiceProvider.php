<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
     *  Client ID: 1
     *   Client secret: evLDgWakLSFU03AHVIzLHZfGeRTx5f2Lzxe5dMOd
     *   Password grant client created successfully.
     *   Client ID: 2
     *   Client secret: 9KzCza5uNryvtaQHgDM66mpCcW1MlOHNink9EXUR
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

    }
}
