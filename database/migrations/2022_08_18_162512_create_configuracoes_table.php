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
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('ti_responsavel_nome')->nullable();
            $table->string('ti_responsavel_telefone')->nullable();
            $table->string('ti_responsavel_email')->nullable();
            $table->enum('integrador', 
                [
                    'Cielo', 
                    'Rede', 
                    'Stone Pagamentos',
                    'Mercado Pago'
                ])->default('Mercado Pago');
            $table->text('keys');
            $table->enum('pix_tipo', 
                [
                    'Celular',
                    'CPF',
                    'CNPJ',
                    'E-mail', 
                    'Chave Aleatória'
                ])->default('Celular');
            $table->string('pix_nome')->nullable();
            $table->string('pix_chave')->nullable();
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
        Schema::dropIfExists('configuracoes');
    }
};
