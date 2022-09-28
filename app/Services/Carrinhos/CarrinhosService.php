<?php

namespace App\Services\Carrinhos;

use App\Repositories\Contracts\CarrinhosRepositoryInterface;
use App\Utils\FormatForm;
use App\Validation\RequestCarrinhos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Realiza o cadastro de um carrinho.
     *
     * @param Request $request
     *
     * @return Array
     */
    public function store(Request $request)
    {
        try {
            $dados = FormatForm::formatCarrinhos($request);

            DB::beginTransaction();

            foreach ($dados as $carrinho) {
                RequestCarrinhos::validarDados($carrinho);

                $this->repository->store($carrinho);

                DB::commit();
            }

            return $dados;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Realiza remoção de um carrinho pela Foreign Key.
     * 
     * @param Int $id
     * 
     * @return Bool
     */
    public function deleteFK(int $id) : bool
    {
        try {
            return $this->repository->deleteFK($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
