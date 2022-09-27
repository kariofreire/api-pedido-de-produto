<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pedidos", function (Blueprint $table) {
            $table->id()->comment("Código do pedido.");
            $table->date("data_pedido")->nullable(false)->comment("Data do pedido.");
            $table->text("observacao")->nullable()->comment("Observação do pedido.");
            $table->enum("forma_pagamento", ["dinheiro", "cartão", "cheque"])->default("dinheiro")->comment("Forma de pagamento do pedido.");
            $table->unsignedBigInteger("cliente_id")->nullable(false)->comment("Coluna que realiza relacionamento com a tabela de clientes.");
            $table->timestamps();
        });

        Schema::table("pedidos", function (Blueprint $table) {
            $table->foreign("cliente_id")->references("id")->on("clientes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
