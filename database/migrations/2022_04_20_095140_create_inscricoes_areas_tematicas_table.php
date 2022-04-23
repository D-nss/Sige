<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\AreaTematica;
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
        Schema::create('inscricoes_areas_tematicas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AreaTematica::class);
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
        Schema::dropIfExists('inscricoes_areas_tematicas');
    }
};
