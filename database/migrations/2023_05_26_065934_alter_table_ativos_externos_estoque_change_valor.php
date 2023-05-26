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
        Schema::table('ativos_externos_estoque', function (Blueprint $table) {
            $table->varchar('valor')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ativos_externos_estoque', function (Blueprint $table) {
            $table->double('valor', 8, 2)->default('0.00');
        });
    }
};