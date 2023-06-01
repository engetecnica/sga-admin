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
            $table->unsignedBigInteger('id_recebedor')->nullable()->after('id_despachante');
            $table->foreign('id_recebedor')->references('id')->on('users');

            $table->dateTime('data_recebimento')->nullable()->after('data_liberacao');
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
            $table->dropForeign(['id_recebedor']);
            $table->dropColumn('id_recebedor');
            $table->dropColumn('data_recebimento');
        });
    }
};
