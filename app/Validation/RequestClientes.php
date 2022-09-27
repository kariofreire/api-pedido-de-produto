<?php

namespace App\Validation;

use App\Exceptions\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RequestClientes
{
    /**
     * Realiza validação dos dados de Clientes.
     *
     * @param Array $dados
     * @param Int $id
     *
     * @return Void
     */
    public static function validarDados(array $dados, int $id = 0) : void
    {
        $regras = [
            'nome'  => ['required'],
            'cpf'   => ['required', 'size:11', Rule::unique("clientes")->ignore($id, "id")],
            'sexo'  => ['required'],
            'email' => ['required', 'email', Rule::unique("clientes")->ignore($id, "id")],
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
