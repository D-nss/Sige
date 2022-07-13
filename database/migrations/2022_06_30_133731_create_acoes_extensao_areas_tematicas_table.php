<?php

use App\Models\AcaoExtensao;
use App\Models\AreaTematica;
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
        Schema::create('acoes_extensao_areas_tematicas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoExtensao::class);
            $table->foreignIdFor(AreaTematica::class);
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
        Schema::dropIfExists('acoes_extensao_areas_tematicas');
    }
};
