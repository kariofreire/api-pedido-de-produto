<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id()->comment("Código do produto.");
            $table->string("nome")->nullable(false)->comment("Nome do cliente.");
            $table->string("cor")->nullable(false)->comment("Cor do produto.");
            $table->string("tamanho")->nullable(false)->comment("Tamanho do produto.");
            $table->decimal("valor", 11, 2)->nullable(false)->comment("Valor do produto.");
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
        Schema::dropIfExists('produtos');
    }
}
