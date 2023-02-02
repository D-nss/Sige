<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Inscricao;
use App\Models\ObjetivoDesenvolvimentoSustentavel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricoes_editais_ods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Inscricao::class);
            $table->foreignIdFor(ObjetivoDesenvolvimentoSustentavel::class);
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
        Schema::dropIfExists('inscricoes_editais_ods');
    }
};
