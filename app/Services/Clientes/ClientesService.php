<?php

namespace App\Services\Clientes;

use App\Repositories\Contracts\ClientesRepositoryInterface;
use Illuminate\Http\Request;

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

	/**
	 * Retorna lista de clientes por filtro.
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

    /**
     * Retorna dados do cliente pelo id.
     *
     * @param Int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function show(int $id)
    {
        try {
            return $this->repository->show($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
