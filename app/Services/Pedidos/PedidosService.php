<?php

namespace App\Services\Pedidos;

use App\Repositories\Contracts\PedidosRepositoryInterface;
use App\Utils\FormatForm;
use App\Validation\RequestPedidos;
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

    /**
     * Retorna dados do pedido pelo id.
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
     * Realiza o cadastro de um pedido.
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(Request $request)
    {
        try {
            $dados = FormatForm::formatPedidos($request);

            RequestPedidos::validarDados($dados);

            return $this->repository->store($dados);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualiza dados de um pedido.
     *
     * @param Request $request
     * @param Int $id
     *
     * @return Bool
     */
    public function update(Request $request, int $id)
    {
        try {
            $dados = FormatForm::formatPedidos($request);

            RequestPedidos::validarDados($dados);

            return $this->repository->update($id, $dados);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Realiza exclusão de um pedido.
     * 
     * @param Int $id
     * 
     * @return Bool
     */
    public function delete(int $id) : bool
    {
        try {
            return $this->repository->delete($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
