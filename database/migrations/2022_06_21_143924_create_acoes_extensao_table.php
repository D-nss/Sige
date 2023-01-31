<?php

use App\Models\GrauEnvolvimentoEquipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Unidade;
use App\Models\Municipio;
use App\Models\LinhaExtensao;
use App\Models\TipoParceiro;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acoes_extensao', function (Blueprint $table) {
            $table->id();
            //caracterização
            $table->integer('modalidade');
            $table->foreignIdFor(LinhaExtensao::class);
            //gerais
            $table->string('titulo', 255);
            $table->string('descricao', 2500);
            $table->string('palavras_chaves', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('publico_alvo', 250)->nullable();
            $table->integer('estimativa_publico')->nullable();
            // local
            //$table->date('data_inicio');
            //$table->date('data_fim')->nullable();
            $table->foreignIdFor(Municipio::class);
            //coordenador e equipe
            $table->foreignIdFor(User::class); //usuario que cadastrou a acao
            $table->foreignIdFor(Unidade::class);
            $table->string('nome_coordenador', 250)->nullable();
            $table->string('vinculo_coordenador', 250)->nullable();
            $table->string('email_coordenador', 250)->nullable();
            $table->integer('vagas_curricularizacao')->nullable();
            $table->foreignIdFor(GrauEnvolvimentoEquipe::class)->nullable();
            //parceiros e comunidade
            $table->string('impactos_universidade', 2500)->nullable();
            $table->string('impactos_sociedade', 2500)->nullable();
            //$table->float('investimento', 10, 2)->nullable();
            //moderação e status
            $table->bigInteger('aprovado_user_id')->nullable();
            $table->string('status', 250)->nullable();
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
        Schema::dropIfExists('acoes_extensao');
    }
};
