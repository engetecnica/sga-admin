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
        Schema::create('ativos_ferramental_retirada_autenticacao', function (Blueprint $table) {
            $table->id();

            /**
             * id
             * id_retirada
             * id_usuario
             * id_funcionario
             * created_at
             * updated_at
             * deleted_at
             */

            $table->unsignedBigInteger('id_retirada');
            $table->foreign('id_retirada')->references('id')->on('ativos_ferramental_retirada');

            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->unsignedBigInteger('id_funcionario');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');

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
        Schema::dropIfExists('ativos_ferramental_retirada_autenticacao');
    }
};
