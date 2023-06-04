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
        Schema::create('preventivas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('manutencao_id')->unsigned();
            $table->integer('preventiva');
            $table->string('descricao');
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('manutencao_id')->references('id')->on('veiculo_manutencaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preventivas');
    }
};
