<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Unidade;
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
        Schema::create('acoes_culturais', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->string('resumo', 2500);
            $table->string('segmento_cultural', 255)
                  ->comment('Patrimônio; Materiais impressos e literatura; Música; Artes da cena; Artes plásticas e visuais; Cinema; Rádio e televisão; Atividades socioculturais; Jogos e desportos; Natureza e meio-ambiente; Arte, ciência e tecnologia; Outros (qual?)');
            $table->string('palavras_chaves', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('publico_alvo', 250)->nullable()
                  ->comment('Alunos, Servidores técnico-administrativos, Docentes, Pesquisadores, Público externo à universidade');
            $table->integer('estimativa_publico')->nullable();
            //locais
            $table->foreignIdFor(Municipio::class);
            //usuario que inseriu acao cultural
            $table->foreignIdFor(User::class)->nullable();
            //unidade responsável
            $table->foreignIdFor(Unidade::class)->nullable();
            $table->string('nome_coordenador', 250)->nullable();
            $table->string('email_coordenador', 250)->nullable();
            $table->string('vinculo_coordenador', 250)->nullable();
            $table->string('vinculo_ensino', 250)->nullable();
            $table->string('vinculo_pesquisa', 250)->nullable();
            $table->string('vinculo_extensao', 250)->nullable();
            //dados
            $table->integer('gratuito')->comment('1 = gratuito');
            $table->string('tipo_evento', 250)->comment('online, presencial, híbrido');
            $table->integer('financiamento')->comment('1 = há financiamento público');
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
        Schema::dropIfExists('acoes_culturais');
    }
};
