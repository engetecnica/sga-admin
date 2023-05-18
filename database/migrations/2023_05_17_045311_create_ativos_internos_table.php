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
        Schema::create('ativos_internos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obra_id');
            $table->string('numero_serie')->nullable();
            $table->string('patrimonio')->nullable();
            $table->string('titulo')->nullable();
            $table->string('marca')->nullable();
            $table->string('valor_atribuido')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('obra_id')->references('id')->on('obras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ativos_internos');
    }
};
