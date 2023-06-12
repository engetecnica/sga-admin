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
        Schema::table('veiculo_manutencaos', function (Blueprint $table) {
            $table->tinyInteger('situacao')->nullable()->after('valor_do_servico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculo_manutencaos', function (Blueprint $table) {
            $table->dropColumn('situacao');
        });
    }
};
