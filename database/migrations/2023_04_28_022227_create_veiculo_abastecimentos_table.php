<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculo_abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id')->unsigned();
            $table->unsignedBigInteger('fornecedor_id')->unsigned();

            $table->string('combustivel');
            $table->integer('quilometragem');
            $table->float('valor_do_litro');
            $table->integer('quantidade');
            $table->float('valor_total')->nullable();

            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculo_abastecimentos');
    }
};
