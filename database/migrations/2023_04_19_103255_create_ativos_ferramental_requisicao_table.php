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
        Schema::create('ativos_ferramental_requisicao', function (Blueprint $table) {
            $table->id();

            /** 
             * Configurações da Tabela de Requisições
             * 
             * id
             * id_solicitante
             * id_obra_origem
             * id_obra_destino
             * data_liberacao
             * status
             *      - Pendente
             *      - Liberado
             *          - Liberado Parcialmente
             *      - Recusado (recusado pelo administrador)
             *      - Em Trânsito 
             *      - Recebido Parcialmente (recebido parcialmente na obra)
             *      - Finalizado (recebido corretamente)
             * created_at
             * updated_at
             * deleted_at
             */

            $table->unsignedBigInteger('id_solicitante')->nullable();
            $table->foreign('id_solicitante')->references('id')->on('users');

            $table->unsignedBigInteger('id_obra_origem')->nullable();
            $table->foreign('id_obra_origem')->references('id')->on('obras');

            $table->unsignedBigInteger('id_obra_destino')->nullable();
            $table->foreign('id_obra_destino')->references('id')->on('obras');

            $table->dateTime('data_liberacao', $precision = 0)->nullable();
            $table->longText('observacoes')->nullable();

            $table->unsignedBigInteger('status')->nullable();
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
        Schema::dropIfExists('ativos_ferramental_requisicao');
    }
};
