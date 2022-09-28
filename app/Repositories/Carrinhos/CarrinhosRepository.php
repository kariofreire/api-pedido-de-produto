<?php

namespace App\Repositories\Carrinhos;

use App\Models\Carrinhos;
use App\Repositories\Contracts\CarrinhosRepositoryInterface;

class CarrinhosRepository implements CarrinhosRepositoryInterface
{
    /** @var Carrinhos $entity */
    protected Carrinhos $entity;

	/**
	 * Define o Model utilizado neste Repository.
	 *
	 * @return Void
	 */
	public function __construct(Carrinhos $model)
	{
		$this->entity = $model;
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
     * Remove um registro pelo ID (Foregin Key).
     *
     * @param Int $id
     * @param String $foregin_key
     *
     * @return Bool
     */
    public function deleteFK(int $id, string $foregin_key = "pedido_id")
	{
		return $this->entity::query()->where($foregin_key, $id)->delete() ? true : false;
	}
}
