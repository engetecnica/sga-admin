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
            $table->unsignedBigInteger('status_recebido')->nullable()->after('status');
            $table->string('observacao_recebido')->nullable()->after('status_recebido');
            $table->foreign('status_recebido')->references('id')->on('ativos_ferramental_requisicao_status');
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
            $table->dropForeign(['status_recebido']);
            $table->dropColumn('status_recebido');
            $table->dropColumn('observacao_recebido');
        });
    }
};
