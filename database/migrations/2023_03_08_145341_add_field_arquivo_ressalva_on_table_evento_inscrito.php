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
        Schema::table('evento_inscritos', function (Blueprint $table) {
            $table->string('arquivo_ressalva', 500)->nullable();
            $table->string('recurso_arquivo', 500)->nullable();
            $table->string('resposta_recurso', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_inscritos', function (Blueprint $table) {
            $table->dropColumn('arquivo_ressalva');
            $table->dropColumn('recurso_arquivo');
            $table->dropColumn('resposta_recurso');
        });
    }
};
