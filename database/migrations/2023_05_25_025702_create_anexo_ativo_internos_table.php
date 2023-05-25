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
        Schema::create('anexo_ativo_internos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ativo_interno');
            $table->unsignedBigInteger('id_usuario');
            $table->string('titulo');
            $table->string('arquivo');
            $table->text('descricao');
            $table->string('tipo');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_ativo_interno')->references('id')->on('ativos_internos');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexo_ativo_internos');
    }
};
