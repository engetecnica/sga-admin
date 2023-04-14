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
        Schema::create('ativos_ferramental_retirada', function (Blueprint $table) {
            $table->id();

            /*
                Levar em consideração o termo de responsabilidade emitido 
                Configurar Termo de Responsabilidade

                id
                id_relacionamento       -> se a retirada for renovada 
                id_obra                 -> obra de retirada
                id_usuario              -> usuário que fez a retirada
                id_funcionario          -> funcionário que retirou
                data_devolucao_prevista  -> previsão de devolução
                data_devolucao          -> data de devolução (null)
                status                  -> situação da retirada
                    enum(pendente, entregue, devolvido)
                    
                    Pendente -> ao salvar a retirada, torna como pendente para envio do termo
                    Entregue -> item entregue ao funcionário
                    Devolvido -> item devolvido pelo funcionário
                    Cancelado -> retirada cancelada pelo autor
                observacoes
                created_at
                updated_at
                deleted_at
            */

            $table->unsignedBigInteger('id_relacionamento')->nullable();
            $table->foreign('id_relacionamento')->references('id')->on('ativos_ferramental_retirada');

            $table->unsignedBigInteger('id_obra');
            $table->foreign('id_obra')->references('id')->on('obras');

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->unsignedBigInteger('id_funcionario');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');

            $table->dateTime('termo_responsabilidade_gerado', $precision = 0)->nullable();

            $table->dateTime('data_devolucao_prevista', $precision = 0)->nullable();
            $table->dateTime('data_devolucao', $precision = 0)->nullable();
            $table->longText('devolucao_observacoes')->after('data_devolucao')->nullable();

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('ativos_ferramental_status');

            $table->longText('observacoes')->nullable();
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
        Schema::dropIfExists('ativos_ferramental_retirada');
    }
};