<?php

use App\Models\AcaoExtensao;
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
        Schema::create('acoes_extensao_colaboradores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoExtensao::class);
            $table->string('nome', 250);
            $table->string('email', 250)->nullable();
            $table->string('documento', 250)->nullable();
            $table->bigInteger('numero_doc')->nullable();
            $table->string('vinculo', 250);
            $table->integer('carga_horaria')->nullable();
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
        Schema::dropIfExists('acoes_extensao_colaboradores');
    }
};
