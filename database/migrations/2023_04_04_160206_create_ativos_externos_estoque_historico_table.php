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
        Schema::create('ativos_externos_estoque_historico', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_ativo_externo');
            $table->foreign('id_ativo_externo')->references('id')->on('ativos_externos');

            $table->unsignedBigInteger('id_transacao')->default('0');
            
            $table->unsignedBigInteger('id_obra_origem');
            $table->foreign('id_obra_origem')->references('id')->on('obras');

            $table->unsignedBigInteger('id_obra_destino');
            $table->foreign('id_obra_destino')->references('id')->on('obras');

            $table->softDeletes();
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
        Schema::dropIfExists('ativos_externos_estoque_historico');
    }
};
