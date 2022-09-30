<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface PedidosRepositoryInterface
{
    /**
     * Retorna todos os registros com filtro de busca.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
	public function allFilter(Request $request);

	/**
     * Recupera todos os registros.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Retorna registro pelo ID (Primary Key).
     *
     * @param Int $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function show(int $id);

    /**
     * Cadastra um registro.
     *
     * @param Array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(array $data);

    /**
     * Atualiza um registro pelo ID (Primary Key).
     *
     * @param Int $id
     * @param Array $data
     *
     * @return Bool
     */
    public function update(int $id, array $data);

	/**
     * Remove um registro pelo ID (Primary Key).
     *
     * @param Int $id
     *
     * @return Bool
     */
    public function delete(int $id);
}
