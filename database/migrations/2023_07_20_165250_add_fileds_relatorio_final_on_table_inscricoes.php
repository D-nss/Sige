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
        Schema::table('inscricoes', function (Blueprint $table) {
            $table->string('arquivo_relatorio', 255)->nullable();
            $table->float('total_orcamento_realizado', 10,2)->nullable();
            $table->string('justificativa_orcamento_realizado', 1000)->nullable();
            $table->string('arquivo_prestacao_contas', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscricoes', function (Blueprint $table) {
            //
        });
    }
};
