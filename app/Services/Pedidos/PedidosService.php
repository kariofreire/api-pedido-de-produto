<?php

namespace App\Services\Pedidos;

use App\Repositories\Contracts\PedidosRepositoryInterface;

class PedidosService
{
    /** @var PedidosRepositoryInterface $repository */
    protected PedidosRepositoryInterface $repository;

	/**
	 * Define a Interface utilizada neste Service.
	 *
	 * @return Void
	 */
	public function __construct(PedidosRepositoryInterface $pedidosRepository)
	{
		$this->repository = $pedidosRepository;
	}
}
