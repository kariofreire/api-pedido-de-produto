<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Services\Produtos\ProdutosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiProdutosController extends Controller
{
    /** @var ProdutosService $service */
    protected ProdutosService $service;

    /**
     * Define o Service utilizado neste Controller.
     *
     * @param ProdutosService $produtosService
     *
     * @return Void
     */
    public function __construct(ProdutosService $produtosService)
    {
        $this->service = $produtosService;
    }

    /**
     * Retorna todos os produtos.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        try {
            $dados = $this->service->getAllFilter($request);

            return ReturnResponse::success("Dados retornados com sucesso.", $dados);
        } catch (\Exception $e) {
            return ReturnResponse::error("Não foi possível retornar os dados.", ["erro" => $e->getMessage()]);
        }
    }
}
