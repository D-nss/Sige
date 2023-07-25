<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Inscricao;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editais_participantes_projeto', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('categoria');
            $table->string('ra')->nullable();
            $table->string('unidade')->nullable();
            $table->string('instituicao')->nullable();
            $table->float('carga_semanal', 10, 2);
            $table->float('carga_total', 10, 2);
            $table->foreignIdFor(Inscricao::class);
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
        Schema::dropIfExists('editais_participantes_projeto');
    }
};
