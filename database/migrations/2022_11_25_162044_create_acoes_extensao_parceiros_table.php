<?php

use App\Models\AcaoExtensao;
use App\Models\TipoParceiro;
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
        Schema::create('acoes_extensao_parceiros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoExtensao::class);
            $table->string('nome', 250);
            $table->foreignIdFor(TipoParceiro::class)->nullable();
            $table->string('colaboracao', 2500)->nullable();
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
        Schema::dropIfExists('acoes_extensao_parceiros');
    }
};
