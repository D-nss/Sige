<?php

use App\Models\AcaoCultural;
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
        Schema::create('acoes_culturais_datas_locais', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoCultural::class);
            $table->date('data');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('local');
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
        Schema::dropIfExists('acoes_culturais_datas_locais');
    }
};
