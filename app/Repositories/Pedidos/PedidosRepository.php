<?php

namespace App\Repositories\Pedidos;

use App\Models\Pedidos;
use App\Repositories\Contracts\PedidosRepositoryInterface;
use Illuminate\Http\Request;

class PedidosRepository implements PedidosRepositoryInterface
{
    /** @var Pedidos $entity */
    protected Pedidos $entity;

	/**
	 * Define o Model utilizado neste Repository.
	 *
	 * @return Void
	 */
	public function __construct(Pedidos $model)
	{
		$this->entity = $model;
	}

    /**
     * Retorna todos os registros com filtro de busca.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
	public function allFilter(Request $request)
	{
		$query = $this->entity::query();

		return $query->orderBy("id")->paginate(10);
	}

	/**
     * Recupera todos os registros.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
	{
		return $this->entity::query()->get();
	}

    /**
     * Retorna registro pelo ID (Primary Key).
     *
     * @param Int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function show(int $id)
	{
		return $this->entity::query()->find($id);
	}

    /**
     * Cadastra um registro.
     *
     * @param Array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(array $data)
	{
		return $this->entity::query()->create($data);
	}

    /**
     * Atualiza um registro pelo ID (Primary Key).
     *
     * @param Int $id
     * @param Array $data
     *
     * @return Bool
     */
    public function update(int $id, array $data)
	{
		return $this->entity::query()->find($id)->update($data);
	}

	/**
     * Remove um registro pelo ID (Primary Key).
     *
     * @param Int $id
     *
     * @return Bool
     */
    public function delete(int $id)
	{
		return $this->entity::query()->find($id)->delete();
	}
}
