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
        Schema::create('acoes_extensao_curricularizacao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('acao_extensao_ocorrencia_id');
            $table->string('aluno_ra', 15);
            $table->string('status', 30)->nullable();
            $table->decimal('horas', 10, 2)->nullable();
            $table->boolean('apto')->nullable();
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
        Schema::dropIfExists('acoes_extensao_curricularizacao');
    }
};
