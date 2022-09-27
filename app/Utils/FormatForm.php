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
}
