<?php

namespace App\Validation;

use App\Exceptions\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RequestClientes
{
    /**
     * Realiza validação dos dados de Clientes.
     *
     * @param Array $dados
     *
     * @return Void
     */
    public static function validarDados(array $dados) : void
    {
        $regras = [
            'nome'  => ['required'],
            'cpf'   => ['required', 'size:11', 'unique:clientes'],
            'sexo'  => ['required'],
            'email' => ['required', 'email', 'unique:clientes'],
        ];

        $mensagens = [
            'nome.required'  => 'É obrigatório informar o nome do cliente.',
            'cpf.required'   => 'É obrigatório informar o cpf do cliente.',
            'cpf.size'       => 'É obrigatório informar um cpf válido.',
            'cpf.unique'     => 'CPF já em uso por um cliente.',
            'sexo.required'  => 'É obrigatório informar o sexo do cliente.',
            'email.required' => 'É obrigatório informar o email do cliente.',
            'email.email'    => 'É obrigatório informar um email válido.',
            'email.unique'   => 'Email já em uso por um cliente.',
        ];

        $validador = Validator::make($dados, $regras, $mensagens);

        if ($validador->fails()) {
            $mensagens = [];

            foreach ($validador->errors()->getMessages() as $mensagem) $mensagens = array_merge($mensagens, $mensagem);

            throw new ValidationException(implode(" ", $mensagens), Response::HTTP_BAD_REQUEST);
        }
    }
}
