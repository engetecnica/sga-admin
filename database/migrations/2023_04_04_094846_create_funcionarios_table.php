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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            // $table->char('matricula', 50)->unique();
            $table->integer('matricula');

            $table->unsignedBigInteger('id_obra')->unsigned();
            $table->foreign('id_obra')->references('id')->on('obras');

            $table->unsignedBigInteger('id_funcao')->nullable();
            $table->foreign('id_funcao')->references('id')->on('funcionarios_funcoes');

            $table->string('nome')->nullable();
            $table->integer('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('email')->nullable();
            $table->string('celular')->nullable();
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
        Schema::dropIfExists('funcionarios');
    }
};
