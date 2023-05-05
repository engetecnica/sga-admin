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

            $table->string('periodo_inicial')->nullable();
            $table->string('periodo_final')->nullable();
            $table->string('tipo')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('ano')->nullable();
            $table->string('veiculo')->nullable();
            $table->string('valor_fipe')->nullable();
            $table->string('codigo_fipe')->nullable();
            $table->string('fipe_mes_referencia')->nullable();
            $table->string('placa')->nullable();
            $table->string('codigo_da_maquina')->nullable();
            $table->string('marca_da_maquina')->nullable();
            
            $table->string('renavam')->nullable();
            $table->string('horimetro_inicial')->nullable();
            $table->longText('observacao')->nullable();
            $table->string('situacao')->nullable();

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
        Schema::dropIfExists('veiculos');
    }
};
