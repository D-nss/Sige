<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Questao;
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
        Schema::create('questoes_respondidas', function (Blueprint $table) {
            $table->id();
            $table->string('resposta', 450);
            $table->foreignIdFor(Questao::class);
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
        Schema::dropIfExists('questoes_respondidas');
    }
};
