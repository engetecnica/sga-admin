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
        Schema::create('ativos_ferramental_requisicao_item', function (Blueprint $table) {
            $table->id();

            /*
                id
                id_requisicao
                id_ativo_externo
                quantidade_solicitada
                status
                created_at
                updated_at
                deleted_at
            */

            $table->unsignedBigInteger('id_ativo_externo');
            $table->foreign('id_ativo_externo')->references('id')->on('ativos_externos_estoque');

            $table->unsignedBigInteger('id_requisicao');
            $table->foreign('id_requisicao')->references('id')->on('ativos_ferramental_requisicao');

            $table->integer('quantidade_solicitada')->nullable()->default('0');

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('ativos_ferramental_requisicao_status');

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
        Schema::dropIfExists('ativos_ferramental_requisicao_item');
    }
};
