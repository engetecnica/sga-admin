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
        Schema::create('veiculo_quilometragems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id')->unsigned();

            $table->integer('quilometragem_atual')->nullable();
            $table->integer('quilometragem_nova')->nullable();

            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculo_quilometragems');
    }
};
