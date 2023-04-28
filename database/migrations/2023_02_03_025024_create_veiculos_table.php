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

            // $table->string('obra');

            $table->string('periodo_inicial');
            $table->string('periodo_final');

            $table->string('tipo');
            $table->string('marca');
            $table->string('modelo');

            $table->string('ano');
            $table->string('veiculo');

            $table->float('valor_fipe');
            $table->string('codigo_fipe');
            $table->string('fipe_mes_referencia');

            $table->string('placa');
            $table->string('renavam');

            // $table->string('km');
            $table->string('horimetro_inicial')->nullable();


            $table->float('valor_funcionario');
            $table->float('valor_adicional');

            $table->longText('observacao')->nullable();

            $table->string('situacao');

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
        Schema::dropIfExists('veiculos');
    }
};
