<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\AcaoCultural;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_culturais_colaboradores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoCultural::class);
            $table->string('nome', 250);
            $table->string('email', 250)->nullable();
            $table->bigInteger('cpf')->nullable();
            $table->string('vinculo', 250);
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
        Schema::dropIfExists('acoes_culturais_colaboradores');
    }
};
