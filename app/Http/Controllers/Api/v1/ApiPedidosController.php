<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Services\Pedidos\PedidosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiPedidosController extends Controller
{
    /** @var PedidosService $service */
    protected PedidosService $service;

    /**
     * Define o Service utilizado neste Controller.
     *
     * @param PedidosService $pedidosService
     *
     * @return Void
     */
    public function __construct(PedidosService $pedidosService)
    {
        $this->service = $pedidosService;
    }

    /**
     * Retorna todos os pedidos.
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

    /**
     * Retorna pedido pelo ID.
     *
     * @param Int $id
     *
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        try {
            $dados = $this->service->show($id);

            return ReturnResponse::success("Dados retornados com sucesso.", $dados);
        } catch (\Exception $e) {
            return ReturnResponse::error("Não foi possível retornar os dados.", ["erro" => $e->getMessage()]);
        }
    }
}
