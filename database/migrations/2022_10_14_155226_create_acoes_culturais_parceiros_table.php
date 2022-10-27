<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\AcaoCultural;
use App\Models\TipoParceiro;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_culturais_parceiros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoCultural::class);
            $table->string('nome', 250);
            $table->foreignIdFor(TipoParceiro::class)->nullable();
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
        Schema::dropIfExists('acoes_culturais_parceiros');
    }
};
