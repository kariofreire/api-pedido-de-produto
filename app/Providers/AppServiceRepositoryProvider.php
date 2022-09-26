<?php

namespace App\Providers;

use App\Repositories\Contracts\ClientesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /** Clientes */
        $this->app->bind(ClientesRepositoryInterface::class, ClientesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
