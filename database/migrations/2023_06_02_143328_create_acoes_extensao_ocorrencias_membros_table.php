<?php

use App\Models\AcaoExtensaoOcorrencia;
use App\Models\User;
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
        Schema::create('acoes_extensao_ocorrencias_membros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcaoExtensaoOcorrencia::class);
            $table->foreignIdFor(User::class)->nullable();
            $table->string('nome', 250);
            $table->string('email', 250)->nullable();
            $table->string('instituicao')->nullable();
            $table->string('cpf', 20)->nullable();
            $table->string('vinculo', 250);
            $table->string('whatsapp', 20)->nullable();
            $table->string('funcao');
            $table->integer('carga_horaria')->nullable();
            $table->boolean('funcionario_unicamp')->default(0)->nullable();
            $table->boolean('aluno_unicamp')->nullable();
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
        Schema::dropIfExists('acoes_extensao_ocorrencias_membros');
    }
};
