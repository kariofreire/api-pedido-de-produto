<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\ValidationException;
use App\Helpers\ReturnResponse;
use App\Http\Controllers\Controller;
use App\Services\Carrinhos\CarrinhosService;
use App\Services\Clientes\ClientesService;
use App\Services\Pedidos\PedidosService;
use App\Services\Produtos\ProdutosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPedidosController extends Controller
{
    /** @var PedidosService $service */
    protected PedidosService $service;

    /** @var CarrinhosService $carrinhos_service */
    protected CarrinhosService $carrinhos_service;
    
    /** @var ClientesService $clientes_service */
    protected ClientesService $clientes_service;

    /** @var ProdutosService $produtos_service */
    protected ProdutosService $produtos_service;

    /**
     * Define o Service utilizado neste Controller.
     *
     * @param PedidosService $pedidosService
     * @param CarrinhosService $carrinhosService
     * @param ClientesService $clientesService
     * @param ProdutosService $produtosService
     *
     * @return Void
     */
    public function __construct(
        PedidosService $pedidosService,
        CarrinhosService $carrinhosService,
        ClientesService $clientesService,
        ProdutosService $produtosService
    )
    {
        $this->service           = $pedidosService;
        $this->carrinhos_service = $carrinhosService;
        $this->clientes_service  = $clientesService;
        $this->produtos_service  = $produtosService;
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
     * Retorna lista de dados necessário para cadastrar um pedido.
     * 
     * @return JsonResponse
     */
    public function create() : JsonResponse
    {
        try {
            $dados = [
                "clientes" => $this->clientes_service->all(),
                "produtos" => $this->produtos_service->all()
            ];

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

    /**
     * Realiza atualizacao de um pedido.
     * 
     * @param Request $request
     * @param Int $id
     * 
     * @return JsonResponse
     */
    public function update(Request $request, int $id) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $dados = $this->service->update($request, $id);

            $request->merge(["pedido_id" => $id]);

            $this->carrinhos_service->deleteFK($id);

            $this->carrinhos_service->store($request);

            DB::commit();

            return ReturnResponse::success("Dados atualizados com sucesso.", $dados);
        } catch (ValidationException $e) {
            DB::rollBack();
            return ReturnResponse::warning($e->getMessage(), [], $e->getCode());
        } catch (\Exception $e) {
            DB::rollBack();
            return ReturnResponse::error("Não foi possível atualizar os dados.", ["erro" => $e->getMessage()]);
        }
    }

    /**
     * Realiza exclusão de um pedido.
     * 
     * @param Int $id
     * 
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $this->carrinhos_service->deleteFK($id);
            
            $dados = $this->service->delete($id);

            DB::commit();

            return ReturnResponse::success("Dados atualizados com sucesso.", $dados);
        } catch (\Exception $e) {
            DB::rollBack();

            return ReturnResponse::error("Não foi possível atualizar os dados.", ["erro" => $e->getMessage()]);
        }
    }
}
