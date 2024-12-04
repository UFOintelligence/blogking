<?php

namespace App\Providers;

use App\Models\Dashboard;
use Illuminate\Contracts\View\View;
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
        //compartir la variable globalmente
        $dashboard = Dashboard::first(); // Ajusta según tu lógica
        view()->share('dashboard', $dashboard);
    }
}
