<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\ValidationException;
use App\Helpers\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Services\Carrinhos\CarrinhosService;
use App\Services\Pedidos\PedidosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPedidosController extends Controller
{
    /** @var PedidosService $service */
    protected PedidosService $service;

    /** @var CarrinhosService $service */
    protected CarrinhosService $carrinhos_service;

    /**
     * Define o Service utilizado neste Controller.
     *
     * @param PedidosService $pedidosService
     * @param CarrinhosService $carrinhosService
     *
     * @return Void
     */
    public function __construct(PedidosService $pedidosService, CarrinhosService $carrinhosService)
    {
        $this->service = $pedidosService;
        $this->carrinhos_service = $carrinhosService;
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

    /**
     * Realiza o cadastro de um pedido.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $dados = $this->service->store($request);

            $request->merge(["pedido_id" => $dados->id]);

            $this->carrinhos_service->store($request);

            DB::commit();

            return ReturnResponse::success("Dados cadastrados com sucesso.", $dados);
        } catch (ValidationException $e) {
            DB::rollBack();
            return ReturnResponse::warning($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            DB::rollBack();
            return ReturnResponse::error("Não foi possível cadastrar os dados.", ["erro" => $e->getMessage()]);
        }
    }
}
