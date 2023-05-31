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
        Schema::table('ativos_ferramental_requisicao_item', function (Blueprint $table) {
            $table->integer('quantidade_liberada')->nullable()->after('quantidade_solicitada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ativos_ferramental_requisicao_item', function (Blueprint $table) {
            $table->dropColumn('quantidade_liberada');
        });
    }
};
