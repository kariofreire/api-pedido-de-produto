<?php

namespace App\Services\Produtos;

use App\Repositories\Contracts\ProdutosRepositoryInterface;
use App\Utils\FormatForm;
use App\Validation\RequestProdutos;
use Illuminate\Http\Request;

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

    /**
	 * Retorna lista de produtos por filtro.
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
     * Retorna dados do produto pelo id.
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
     * Realiza o cadastro de um produto.
     *
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function store(Request $request)
    {
        try {
            $dados = FormatForm::formatProdutos($request);

            RequestProdutos::validarDados($dados);

            return $this->repository->store($dados);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
