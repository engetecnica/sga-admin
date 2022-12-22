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
        Schema::create('produtos_estoque', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_produto_configuracao');

            $table->foreign('id_produto')->references('id')->on('produtos'); 
            $table->foreign('id_produto_configuracao')->references('id')->on('produtos_configuracoes'); 
            $table->datetime('data_venda')->nullable();
            $table->enum('status', 
                [
                    'Liberado', 
                    'Vendido', 
                    'Outro'
                ])->default('Liberado');
            $table->integer('codigo')->default('0');
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
        Schema::dropIfExists('produtos_estoque');
    }
};
