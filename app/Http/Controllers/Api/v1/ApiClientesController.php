<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Services\Clientes\ClientesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiClientesController extends Controller
{
    /** @var ClientesService $service */
    protected ClientesService $service;

    /**
     * Define o Service utilizado neste Controller.
     *
     * @param ClientesService $clientesService
     *
     * @return Void
     */
    public function __construct(ClientesService $clientesService)
    {
        $this->service = $clientesService;
    }

    /**
     * Retorna todas as categorias em JSON.
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
