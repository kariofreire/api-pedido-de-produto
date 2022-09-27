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
            $table->string("nome")->comment("Nome do cliente.");
            $table->string("cpf", 11)->comment("Cadastro de Pessoa Física do cliente.");
            $table->enum("sexo", ["masculino", "feminino"])->comment("Sexo do cliente, lembrando que, sexo está relacionado às distinções anatômicas e biológicas entre homens e mulheres.");
            $table->string("email")->comment("Email do cliente");
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
