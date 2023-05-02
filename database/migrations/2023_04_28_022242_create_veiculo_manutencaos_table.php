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
        Schema::create('veiculo_manutencaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id')->unsigned();
            $table->unsignedBigInteger('fornecedor_id')->unsigned();
            $table->unsignedBigInteger('servico_id')->unsigned();

            $table->enum('tipo', ['corretiva', 'preventiva']);
            $table->string('quilometragem_atual')->nullable();
            $table->string('quilometragem_proxima')->nullable();
            $table->string('horimetro_atual')->nullable();
            $table->string('horimetro_proximo')->nullable();
            $table->date('data_de_execucao')->nullable();
            $table->date('data_de_vencimento')->nullable();
            $table->longText('descricao')->nullable();
            $table->float('valor_do_servico');
            $table->timestamps();
            
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            $table->foreign('servico_id')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculo_manutencaos');
    }
};
