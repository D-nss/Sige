<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Certificado;
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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('local', 250);
            $table->boolean('gratuito')->nullable();
            $table->boolean('online')->nullable();
            $table->boolean('hibrido')->nullable();
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->string('detalhes', 5000);
            $table->boolean('inscricao')->default(0);
            $table->dateTime('inscricao_inicio')->nullable();
            $table->dateTime('inscricao_fim')->nullable();
            $table->integer('vagas')->nullable();
            $table->boolean('ck_documento')->nullable();
            $table->boolean('ck_sexo')->nullable();
            $table->boolean('ck_identidade_genero')->nullable();
            $table->boolean('ck_nascimento')->nullable();
            $table->boolean('ck_instituicao')->nullable();
            $table->boolean('ck_vinculo')->nullable();
            $table->boolean('ck_area')->nullable();
            $table->boolean('ck_funcao')->nullable();
            $table->boolean('ck_pais')->nullable();
            $table->boolean('ck_cidade_estado')->nullable();
            $table->boolean('ck_arquivo')->nullable();
            $table->float('carga_horaria', 10, 2)->nullable();
            $table->boolean('doc_certificado')->nullable();
            $table->foreignIdFor(Certificado::class);
            $table->foreignIdFor(User::class);
            $table->string('grupo_usuario');
            $table->string('status');
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
        Schema::dropIfExists('eventos');
    }
};
