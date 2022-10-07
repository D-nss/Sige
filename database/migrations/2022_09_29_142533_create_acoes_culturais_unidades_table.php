<?php

use App\Models\AcaoCultural;
use App\Models\Unidade;
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
        Schema::create('acoes_culturais_unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoCultural::class);
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
        Schema::dropIfExists('acoes_culturais_unidades');
    }
};
