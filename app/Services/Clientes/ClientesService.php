<?php

namespace App\Services\Clientes;

use App\Repositories\Contracts\ClientesRepositoryInterface;
use App\Utils\FormatForm;
use App\Validation\RequestClientes;
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

    /**
     * Realiza o cadastro de um cliente.
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(Request $request)
    {
        try {
            $dados = FormatForm::formatClientes($request);

            RequestClientes::validarDados($dados);

            return $this->repository->store($dados);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualiza dados de um cliente.
     *
     * @param Int $id
     * @param Request $request
     *
     * @return Bool
     */
    public function update(Request $request, $id)
    {
        try {
            $dados = FormatForm::formatClientes($request);

            RequestClientes::validarDados($dados, $id);

            return $this->repository->update($id, $dados);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove dados de um cliente.
     *
     * @param Int $id
     *
     * @return Bool
     */
    public function delete(int $id)
    {
        try {
            return $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
