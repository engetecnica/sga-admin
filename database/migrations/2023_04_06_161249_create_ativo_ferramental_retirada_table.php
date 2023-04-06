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
        Schema::create('ativo_ferramental_retirada', function (Blueprint $table) {
            $table->id();

            /*
                id
                id_obra
                id_funcionario
                data_devolucao_previsa
                data_devolucao
                status
                    enum(pendente, entregue, devolvido)
                observacoes
                created_at
                updated_at
                deleted_at
            */

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
        Schema::dropIfExists('ativo_ferramental_retirada');
    }
};
