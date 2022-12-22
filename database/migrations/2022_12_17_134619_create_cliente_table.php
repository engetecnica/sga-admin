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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empresa');
                $table->foreign('id_empresa')->references('id')->on('empresas'); 

            $table->string('nome')->nullable();
            $table->date('data_de_nascimento')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('cpf')->nullable();
            $table->enum('status', ['Ativo', 'Inativo']);
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
        Schema::dropIfExists('clientes');
    }
};
