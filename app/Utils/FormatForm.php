<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Http\Request;

class FormatForm
{
    /**
     * Formata valores de campos que vem do formulário de clientes.
     *
     * @param Request $request
     *
     * @return Array
     */
    public static function formatClientes(Request $request) : array
    {
        return collect($request)->map(function ($dados, $key) {
            switch ($key) {
                case "cpf":
                    $cpf = str_replace([".", "-"], "", $dados);
                    return ValidaCPF::get($cpf) ? $cpf : "{$cpf}0";

                case "sexo":
                    $sexo      = trim(strtolower($dados));
                    $nome_sexo = str_contains($sexo, "masculino") ? "masculino" : "feminino";

                    return in_array($sexo, ["masculino", "feminino"]) ? $nome_sexo : "prefiro não informar";

                default:
                    return $dados;
            }
        })->filter()->toArray();
    }

    /**
     * Formata valores de campos que vem do formulário de produtos.
     *
     * @param Request $request
     *
     * @return Array
     */
    public static function formatProdutos(Request $request) : array
    {
        return collect($request)->map(function ($dados, $key) {
            switch ($key) {
                case "valor":
                    return substr_replace(preg_replace("/[^0-9]/", "", trim($dados)), '.', -2, 0);

                default:
                    return $dados;
            }
        })->filter()->toArray();
    }

    /**
     * Formata valores de campos que vem do formulário de pedidos.
     *
     * @param Request $request
     *
     * @return Array
     */
    public static function formatPedidos(Request $request) : array
    {
        return collect($request->only(["data_pedido", "observacao", "forma_pagamento", "valor_total", "cliente_id"]))->map(function ($dados, $key) {
            switch ($key) {
                case "valor_total":
                    return substr_replace(preg_replace("/[^0-9]/", "", trim($dados)), '.', -2, 0);

                default:
                    return $dados;
            }
        })->filter()->toArray();
    }

    /**
     * Formata valores de campos que vem do formulário de carrinhos.
     *
     * @param Request $request
     *
     * @return Array
     */
    public static function formatCarrinhos(Request $request) : array
    {
        return collect($request->get("produto_id"))->map(function ($produto_id, $key) use ($request) {
            $quantidade = collect($request->get("quantidade"))->get($key);
            $valor      = collect($request->get("valor"))->get($key);

            return [
                "quantidade" => (int) $quantidade,
                "valor"      => substr_replace(preg_replace("/[^0-9]/", "", trim($valor)), '.', -2, 0),
                "produto_id" => (int) $produto_id,
                "pedido_id"  => (int) $request->get("pedido_id")
            ];
        })->toArray();
    }
}
