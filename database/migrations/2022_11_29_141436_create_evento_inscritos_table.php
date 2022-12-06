<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Evento;
use App\Models\Municipio;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_inscritos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('tipo_documento')->nullable();
            $table->string('documento')->nullable();
            $table->string('instituicao')->nullable();
            $table->string('pais')->nullable();
            $table->string('area')->nullable();
            $table->string('vinculo')->nullable();
            $table->date('nascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('genero')->nullable();
            $table->string('funcao')->nullable();
            $table->string('municipio')->nullable();
            $table->string('arquivo')->nullable();
            $table->string('certificado')->nullable();
            $table->boolean('certificado_enviado')->default(0);
            $table->foreignIdFor(Evento::class);
            $table->boolean('presenca')->default(0);
            $table->boolean('confirmacao')->default(0);
            $table->timestamp('data_confirmacao')->nullable();
            $table->string('personalizado')->nullable();
            $table->boolean('lista_espera')->default(0);
            $table->integer('posicao_espera')->default(0);
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
        Schema::dropIfExists('evento_inscritos');
    }
};
