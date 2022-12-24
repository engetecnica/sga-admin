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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_produto');

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_produto')->references('id')->on('produtos'); 

            $table->dateTime('data_vencimento')->nullable(); // vencimento
            $table->enum('status', 
                [
                    'Pendente', 
                    'Entregue', 
                    'Cancelado'
                ]);
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
        Schema::dropIfExists('vendas');
    }
};
