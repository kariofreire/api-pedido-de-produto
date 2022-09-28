<?php

namespace App\Validation;

use App\Exceptions\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RequestPedidos
{
    /**
     * Realiza validação dos dados de Pedidos.
     *
     * @param Array $dados
     *
     * @return Void
     */
    public static function validarDados(array $dados) : void
    {
        $regras = [
            'data_pedido'     => ['required'],
            'forma_pagamento' => ['required'],
            'valor_total'     => ['required'],
            'cliente_id'      => ['required'],
        ];

        $mensagens = [
            'data_pedido.required'     => 'É obrigatório informar data do pedido.',
            'forma_pagamento.required' => 'É obrigatório informar a forma de pagamento.',
            'valor_total.required'     => 'É obrigatório informar o valor total do carrinho.',
            'cliente_id.required'      => 'É obrigatório informar um cliente.',
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            $mensagens = [];

            foreach ($validador->errors()->getMessages() as $mensagem) $mensagens = array_merge($mensagens, $mensagem);

            throw new ValidationException(implode(" ", $mensagens), Response::HTTP_BAD_REQUEST);
        }
    }
}
