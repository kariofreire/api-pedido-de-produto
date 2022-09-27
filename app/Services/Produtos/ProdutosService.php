<?php

namespace App\Services\Produtos;

use App\Repositories\Contracts\ProdutosRepositoryInterface;

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
}
