<?php

namespace App\Services\Clientes;

use App\Repositories\Contracts\ClientesRepositoryInterface;

class ClientesService
{
	/** @var ClientesRepositoryInterface $repository */
    protected ClientesRepositoryInterface $repository;

	/**
	 * Define a Interface utilizada neste Service.
	 *
	 * @return Void
	 */
	public function __construct(ClientesRepositoryInterface $clientesRepository)
	{
		$this->repository = $clientesRepository;
	}
}
