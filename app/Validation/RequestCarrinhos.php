<?php

namespace App\Validation;

use App\Exceptions\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RequestCarrinhos
{
    /**
     * Realiza validação dos dados de Carrinhos.
     *
     * @param Array $dados
     *
     * @return Void
     */
    public static function validarDados(array $dados) : void
    {
        $regras = [
            'quantidade' => ['required'],
            'valor'      => ['required'],
            'produto_id' => ['required']
        ];

        $mensagens = [
            'quantidade.required' => 'É obrigatório informar a quantidade do produto.',
            'valor.required'      => 'É obrigatório informar o valor do produto.',
            'produto_id.required' => 'É obrigatório informar o produto.'
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            $mensagens = [];

            foreach ($validador->errors()->getMessages() as $mensagem) $mensagens = array_merge($mensagens, $mensagem);

            throw new ValidationException(implode(" ", $mensagens), Response::HTTP_BAD_REQUEST);
        }
    }
}
