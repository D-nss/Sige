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
        Schema::table('acoes_extensao_curricularizacao', function (Blueprint $table) {
            $table->string('carta_apresentacao', 2500)->nullable();
            $table->string('justificativa', 2500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acoes_extensao_curricularizacao', function (Blueprint $table) {
            $table->dropColumn('carta_apresentacao');
            $table->dropColumn('justificativa');
        });
    }
};
