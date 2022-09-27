<?php

namespace App\Services\Produtos;

use App\Repositories\Contracts\ProdutosRepositoryInterface;
use Illuminate\Http\Request;

class ProdutosService
{
    /** @var ProdutosRepositoryInterface $repository */
    protected ProdutosRepositoryInterface $repository;

	/**
	 * Define a Interface utilizada neste Service.
	 *
	 * @return Void
	 */
	public function __construct(ProdutosRepositoryInterface $produtosRepository)
	{
		$this->repository = $produtosRepository;
	}

    /**
	 * Retorna lista de produtos por filtro.
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
