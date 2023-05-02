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
        Schema::create('veiculo_depreciacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id')->unsigned();

            $table->string('valor_atual');

            $table->string('referencia_mes');
            $table->string('referencia_ano');

            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculo_depreciacaos');
    }
};
