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
        Schema::create('ativos_ferramental_retirada_item', function (Blueprint $table) {
            $table->id();

            /*
                id
                id_retirada
                id_ativo_externo
                status
                created_at
                updated_at
                deleted_at
            */

            $table->unsignedBigInteger('id_ativo_externo');
            $table->foreign('id_ativo_externo')->references('id')->on('ativos_externos_estoque');

            $table->unsignedBigInteger('id_retirada');
            $table->foreign('id_retirada')->references('id')->on('ativos_ferramental_retirada');

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('ativos_ferramental_status');

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
        Schema::dropIfExists('ativos_ferramental_retirada_item');
    }
};
