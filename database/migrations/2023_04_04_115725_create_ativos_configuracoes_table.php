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
        Schema::create('ativos_configuracoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_relacionamento');
            $table->string('titulo')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
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
        Schema::dropIfExists('ativos_configuracoes');
    }
};