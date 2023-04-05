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
        Schema::create('ativos_externos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ativo_configuracao');
            $table->foreign('id_ativo_configuracao')->references('id')->on('ativos_configuracoes');
            $table->string('titulo')->nullable();            
            $table->enum('status', ['Ativo', 'Inativo']);
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
        Schema::dropIfExists('ativos_externos');
    }
};
