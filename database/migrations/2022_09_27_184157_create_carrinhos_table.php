<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("carrinhos", function (Blueprint $table) {
            $table->id()->comment("ID de referência da tabela de carrinhos.");
            $table->integer("quantidade")->default(1)->comment("Quantidade de produtos adicionado a esse item.");
            $table->decimal("valor_total", 11, 2)->nullable(false)->comment("Valor total do pedido do carrinho.");
            $table->unsignedBigInteger("produto_id")->nullable(false)->comment("Coluna que realiza relacionamento com a tabela de produtos.");
            $table->unsignedBigInteger("pedido_id")->nullable(false)->comment("Coluna que realiza relacionamento com a tabela de pedido.");
            $table->timestamps();
        });

        Schema::table("carrinhos", function (Blueprint $table) {
            $table->foreign("produto_id")->references("id")->on("produtos");
            $table->foreign("pedido_id")->references("id")->on("pedidos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrinhos');
    }
}
