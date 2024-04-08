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
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->string('anotacoes', 500);
            $table->string('mensagem_extensao', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->dropColumn('anotacoes');
            $table->dropColumn('mensagem_extensao');
        });
    }
};
