<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Unidade;
use App\Models\Indicador;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores_unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Indicador::class);
            $table->integer('valor');
            $table->text('ano_base');
            $table->foreignIdFor(Unidade::class);
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
        Schema::dropIfExists('indicadores_unidades');
    }
};
