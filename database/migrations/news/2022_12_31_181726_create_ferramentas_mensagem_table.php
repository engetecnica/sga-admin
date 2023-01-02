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
        Schema::create('ferramentas_mensagem', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->enum(
                'tipo',
                [
                    'mensagem',
                    'cobranca'
                ]
            );
            $table->string('whatsapp')->nullable();
            $table->text('mensagem')->nullable();
            $table->enum(
                'status',
                [
                    'Enviado',
                    'Pendente',
                    'Erro ao Enviar'
                ]
            );

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
        Schema::dropIfExists('ferramentas_mensagem');
    }
};
