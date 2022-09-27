<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\ValidationException;
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
     * Retorna todas os clientes.
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
     * Retorna cliente pelo ID.
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
     * Realiza o cadastro de um cliente.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            $dados = $this->service->store($request);

            return ReturnResponse::success("Dados cadastrados com sucesso.", $dados);
        } catch (ValidationException $e) {
            return ReturnResponse::warning($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            return ReturnResponse::error("Não foi possível cadastrar os dados.", ["erro" => $e->getMessage()]);
        }
    }

    /**
     * Realiza atualização de dados de um cliente.
     *
     * @param Request $request
     * @param Int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id) : JsonResponse
    {
        try {
            $dados = $this->service->update($request, $id);

            return ReturnResponse::success("Dados atualizados com sucesso.", $dados);
        } catch (ValidationException $e) {
            return ReturnResponse::warning($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            return ReturnResponse::error("Não foi possível atualizar os dados.", ["erro" => $e->getMessage()]);
        }
    }
}
