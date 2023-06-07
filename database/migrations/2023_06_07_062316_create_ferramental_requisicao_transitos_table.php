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
        Schema::create('ferramental_requisicao_transitos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_requisicao')->unsigned();
            $table->unsignedBigInteger('id_ativo')->unsigned();
            $table->unsignedBigInteger('id_obra_origem')->unsigned();
            $table->unsignedBigInteger('id_obra_destino')->unsigned();
            $table->string('observacao_recebimento')->nullable();
            $table->unsignedBigInteger('status')->default(5)->nullable();
            $table->timestamps();

            $table->foreign('id_requisicao')->references('id')->on('ativos_ferramental_requisicao');
            $table->foreign('id_ativo')->references('id')->on('ativos_externos_estoque');
            $table->foreign('id_obra_origem')->references('id')->on('obras');
            $table->foreign('id_obra_destino')->references('id')->on('obras');
            $table->foreign('status')->references('id')->on('ativos_ferramental_requisicao_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ferramental_requisicao_transitos');
    }
};
