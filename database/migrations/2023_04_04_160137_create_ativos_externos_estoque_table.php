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
        Schema::create('ativos_externos_estoque', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_ativo_externo');
            $table->foreign('id_ativo_externo')->references('id')->on('ativos_externos');

            $table->unsignedBigInteger('id_obra')->nullable();
            $table->foreign('id_obra')->references('id')->on('obras');

            $table->char('patrimonio', 50)->nullable();
            $table->date('data_descarte')->nullable();
            $table->double('valor', 8, 2)->default('0.00');
            $table->boolean('calibracao');
            $table->unsignedBigInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('ativos_externos_estoque');
    }
};