<?php

namespace App\Validation;

use App\Exceptions\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RequestProdutos
{
    /**
     * Realiza validação dos dados de Produtos.
     *
     * @param Array $dados
     *
     * @return Void
     */
    public static function validarDados(array $dados) : void
    {
        $regras = [
            'nome'    => ['required'],
            'cor'     => ['required'],
            'tamanho' => ['required'],
            'valor'   => ['required'],
        ];

        $mensagens = [
            'nome.required'    => 'É obrigatório informar o nome do produto.',
            'cor.required'     => 'É obrigatório informar a cor do produto.',
            'tamanho.required' => 'É obrigatório informar o tamanho do produto.',
            'valor.required'   => 'É obrigatório informar o valor do produto.',
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            $mensagens = [];

            foreach ($validador->errors()->getMessages() as $mensagem) $mensagens = array_merge($mensagens, $mensagem);

            throw new ValidationException(implode(" ", $mensagens), Response::HTTP_BAD_REQUEST);
        }
    }
}
