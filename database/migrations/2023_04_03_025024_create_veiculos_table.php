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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('obra_id');

            $table->string('periodo_inicial');
            $table->string('periodo_final');
            $table->string('tipo');
            $table->string('marca');
            $table->string('modelo');
            $table->string('ano');
            $table->string('veiculo');
            $table->string('valor_fipe');
            $table->string('codigo_fipe');
            $table->string('fipe_mes_referencia');
            $table->string('placa')->nullable();
            $table->string('renavam')->nullable();
            $table->string('horimetro_inicial')->nullable();
            $table->longText('observacao')->nullable();
            $table->string('situacao');

            $table->timestamps();
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
        Schema::dropIfExists('veiculos');
    }
};
