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
        // produto configuracoes (qtde, valor, tipo (mensal, trimestral, semenstral, anual))
        Schema::create('produtos_configuracoes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_produto');

            $table->foreign('id_empresa')->references('id')->on('empresas'); 
            $table->foreign('id_produto')->references('id')->on('produtos'); 

            $table->enum('tipo', 
            [
                'Mensal', 
                'Bimestral', 
                'Trimestral', 
                'Semestral', 
                'Anual', 
                'Diferenciado'
            ])->default('Mensal');
            $table->integer('quantidade_minina')->default('1'); // quantidade mínima versus tipo do plano (mensal = 1, trimestral = 3)
            $table->float('valor_compra')->default('0.00');
            $table->float('valor_venda')->default('0.00');
            $table->float('valor_lucro')->default('0.00');
            $table->string('imagem')->nullable();
            $table->text('observacoes')->nullable();
            $table->enum('status', 
            [
                'Ativo', 
                'Inativo'
            ])->default('Ativo');
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
        Schema::dropIfExists('produtos_configuracoes');
    }
};
