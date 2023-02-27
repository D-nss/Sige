<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Evento;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_equipe', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('email')->nullable();
            $table->string('instituicao')->nullable();
            $table->string('cpf', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('funcao_evento');
            $table->boolean('funcionario_unicamp')->default(0)->nullable();
            $table->boolean('aluno_unicamp')->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Evento::class);
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
        Schema::dropIfExists('evento_equipe');
    }
};
