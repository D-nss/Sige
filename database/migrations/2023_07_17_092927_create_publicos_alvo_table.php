<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\TipoPublico;
use App\Models\Edital;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicos_alvo', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TipoPublico::class);
            $table->foreignIdFor(Edital::class);
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
        Schema::dropIfExists('publicos_alvo');
    }
};
