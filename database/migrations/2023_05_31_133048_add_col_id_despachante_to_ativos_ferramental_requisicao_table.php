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
        Schema::table('ativos_ferramental_requisicao', function (Blueprint $table) {
            $table->unsignedBigInteger('id_despachante')->nullable()->after('id_solicitante');
            $table->foreign('id_despachante')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ativos_ferramental_requisicao', function (Blueprint $table) {
            $table->dropForeign(['id_despachante']);
            $table->dropColumn('id_despachante');
        });
    }
};
