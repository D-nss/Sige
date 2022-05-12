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
        Schema::create('editais', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->string('tipo', 255);
            $table->string('resumo', 1000);
            $table->float('total_recurso', 10, 2);
            $table->float('valor_max_inscricao', 10, 2);
            $table->float('valor_max_programa', 10, 2)->nullable();
            $table->string('anexo_edital', 255);
            $table->string('anexo_imagem', 255)->nullable();
            $table->string('status', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editais');
    }
};
