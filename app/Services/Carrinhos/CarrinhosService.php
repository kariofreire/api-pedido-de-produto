<?php

namespace App\Services\Carrinhos;

use App\Repositories\Contracts\CarrinhosRepositoryInterface;

class CarrinhosService
{
    /** @var CarrinhosRepositoryInterface $repository */
    protected CarrinhosRepositoryInterface $repository;

	/**
	 * Define a Interface utilizada neste Service.
	 *
	 * @return Void
	 */
	public function __construct(CarrinhosRepositoryInterface $carrinhosRepository)
	{
		$this->repository = $carrinhosRepository;
	}
}
