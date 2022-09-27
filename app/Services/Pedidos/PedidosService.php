<?php

namespace App\Services\Pedidos;

use App\Repositories\Contracts\PedidosRepositoryInterface;
use Illuminate\Http\Request;

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

    /**
	 * Retorna lista de pedidos por filtro.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllFilter(Request $request)
	{
		try {
			return $this->repository->allFilter($request);
		} catch (\Throwable $th) {
			throw $th;
		}
	}
}
