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
        Schema::create('acoes_extensao_ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoExtensao::class);
            $table->string('local', 255);
            $table->dateTime('data_hora_inicio');
            $table->dateTime('data_hora_fim');
            $table->dateTime('inicio_inscricoes');
            $table->dateTime('fim_inscricoes');
            $table->string('complemento', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
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
        Schema::dropIfExists('acoes_extensao_ocorrencias');
    }
};
