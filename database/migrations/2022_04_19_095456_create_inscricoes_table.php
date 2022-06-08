<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Unidade;
use App\Models\Edital;
use App\Models\Municipio;
use App\Models\LinhaExtensao;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->string('tipo', 45);
            $table->foreignIdFor(Municipio::class);
            $table->string('resumo', 2500);
            $table->string('palavras_chaves', 190)->nullable();
            $table->char('parceria', 10);
            $table->string('anexo_parceria', 255)->nullable();
            $table->string('anexo_projeto', 255);
            $table->string('url_projeto', 255)->nullable();
            $table->string('url_lattes', 255)->nullable();
            $table->string('status', 190)->nullable();
            $table->string('justificativa', 500)->nullable();
            $table->foreignIdFor(LinhaExtensao::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Unidade::class);
            $table->foreignIdFor(Edital::class);
            $table->bigInteger('analista_user_id')->nullable();
            $table->bigInteger('avaliador_user_id')->nullable();
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
        Schema::dropIfExists('inscricoes');
    }
};
