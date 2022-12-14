<?php

namespace App\Providers;

use App\Repositories\Carrinhos\CarrinhosRepository;
use App\Repositories\Clientes\ClientesRepository;
use App\Repositories\Contracts\CarrinhosRepositoryInterface;
use App\Repositories\Contracts\ClientesRepositoryInterface;
use App\Repositories\Contracts\PedidosRepositoryInterface;
use App\Repositories\Contracts\ProdutosRepositoryInterface;
use App\Repositories\Pedidos\PedidosRepository;
use App\Repositories\Produtos\ProdutosRepository;
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

        /** Produtos */
        $this->app->bind(ProdutosRepositoryInterface::class, ProdutosRepository::class);

        /** Pedidos */
        $this->app->bind(PedidosRepositoryInterface::class, PedidosRepository::class);

        /** Carrinhos */
        $this->app->bind(CarrinhosRepositoryInterface::class, CarrinhosRepository::class);
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
