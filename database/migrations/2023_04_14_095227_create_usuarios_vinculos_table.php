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
        Schema::create('usuarios_vinculos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->unsignedBigInteger('id_obra')->nullable()->default(null);
            $table->foreign('id_obra')->references('id')->on('obras');

            $table->unsignedBigInteger('id_funcionario')->nullable();
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');

            $table->unsignedBigInteger('id_nivel')->nullable();
            $table->foreign('id_nivel')->references('id')->on('usuarios_niveis');

            $table->dateTime('acesso_atual', $precision = 0)->nullable()->default(now());
            $table->dateTime('ultimo_acesso', $precision = 0)->nullable();
            $table->enum(
                'status',
                [
                    'Ativo',
                    'Inativo',
                    'Bloqueado'
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
        Schema::dropIfExists('usuarios_vinculos');
    }
};
