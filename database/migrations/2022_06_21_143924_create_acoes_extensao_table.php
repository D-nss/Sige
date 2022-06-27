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
            $table->integer('tipo');
            $table->foreignIdFor(LinhaExtensao::class);
            $table->string('areas_tematicas', 255);
            //gerais
            $table->string('titulo', 255);
            $table->string('descricao', 2500);
            $table->string('palavras_chaves', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('publico_alvo', 250)->nullable();
            //datas e locais
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->integer('situacao'); // 1=Desativado, 2=Em Andamento, 3=Concluido
            $table->foreignIdFor(Municipio::class);
            $table->string('georreferenciacao', 255); //lista latitude longitude
            //coordenador e equipe
            $table->foreignIdFor(User::class); //usuario que cadastrou a acao
            $table->foreignIdFor(Unidade::class);
            $table->string('nome_coordenador', 250);
            $table->integer('tipo_coordenador');
            $table->string('equipe', 250)->nullable();
            $table->integer('qtd_graduacao')->nullable();
            $table->integer('qtd_pos_graduacao')->nullable();
            //parceiros e comunidade
            $table->string('parceiro')->nullable();
            $table->foreignIdFor(TipoParceiro::class);
            $table->string('impactos_universidade')->nullable();
            $table->string('impactos_sociedade')->nullable();
            $table->foreignIdFor(GrauEnvolvimentoEquipe::class);
            $table->float('investimento', 10, 2)->nullable();
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
