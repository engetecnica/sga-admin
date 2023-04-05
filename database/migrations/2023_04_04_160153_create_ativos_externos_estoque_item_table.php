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
        Schema::create('ativos_externos_estoque_item', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_ativo_externo');
            $table->foreign('id_ativo_externo')->references('id')->on('ativos_externos');

            $table->integer('quantidade_estoque')->default('0');
            $table->integer('quantidade_em_transito')->default('0');
            $table->integer('quantidade_em_operacao')->default('0');
            $table->integer('quantidade_em_manutencao')->default('0');
            $table->integer('quantidade_com_defeito')->default('0');
            $table->integer('quantidade_fora_de_operacao')->default('0');

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
        Schema::dropIfExists('ativos_externos_estoque_item');
    }
};
