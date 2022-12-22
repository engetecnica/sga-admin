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
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_anexo')->nullable(); // id_anexo: em caso de alterações do arquivo, poderá ficar como histórico
            $table->integer('id_usuario')->nullable();
            $table->integer('id_modulo')->nullable();
            $table->integer('id_item')->nullable();
            $table->string('titulo')->nullable();
            $table->text('tipo')->nullable();
            $table->text('arquivo')->nullable();
            $table->text('descricao')->nullable();
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
        Schema::dropIfExists('anexos');
    }
};
