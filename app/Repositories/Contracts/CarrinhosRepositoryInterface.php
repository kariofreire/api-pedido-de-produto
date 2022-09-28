<?php

namespace App\Repositories\Contracts;

interface CarrinhosRepositoryInterface
{
	/**
     * Recupera todos os registros.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Cadastra um registro.
     *
     * @param Array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(array $data);

    /**
     * Remove um registro pelo ID (Foregin Key).
     *
     * @param Int $id
     * @param String $foregin_key
     *
     * @return Bool
     */
    public function deleteFK(int $id, string $foregin_key = "pedido_id");
}
