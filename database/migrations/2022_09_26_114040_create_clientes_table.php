<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id()->comment("Código do cliente.");
            $table->string("nome")->nullable(false)->comment("Nome do cliente.");
            $table->string("cpf", 11)->unique()->nullable(false)->comment("Cadastro de Pessoa Física do cliente.");
            $table->enum("sexo", ["masculino", "feminino", "prefiro não informar"])->default("prefiro não informar")->comment("Sexo do cliente, considerando que, sexo está relacionado às distinções anatômicas e biológicas entre homens e mulheres.");
            $table->string("email")->unique()->nullable(false)->comment("Email do cliente");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
