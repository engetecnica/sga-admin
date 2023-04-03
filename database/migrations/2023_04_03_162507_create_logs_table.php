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

        /*
            id
            id_usuario
            id_modulo
            id_item
            tipo
                adicionar
                editar
                excluir
            descricao
            detalhes
            created_at
            updated_at
            deleted_at
        */


        Schema::create('logs', function (Blueprint $table) {
            
            $table->id();            
            $table->unsignedBigInteger('id_usuario')->unsigned();            
            $table->unsignedBigInteger('id_modulo')->unsigned(); 
            $table->unsignedBigInteger('id_item')->unsigned();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_modulo')->references('id')->on('modulos'); 

            $table->enum('tipo', 
                [
                    'Adicionar', 
                    'Editar',
                    'Excluir',
                    'Enviar Arquivo'
                ]
            );
           
            $table->text('drescricao')->nullable();
            $table->text('detalhes')->nullable();
            $table->ipAddress('ip_acesso');
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
        Schema::dropIfExists('logs');
    }
};
