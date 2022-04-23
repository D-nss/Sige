<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Inscricao;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_itens', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_item');
            $table->string('item');
            $table->string('descricao');
            $table->string('justificativa');
            $table->float('valor', 10, 2);
            $table->foreignIdFor(Inscricao::class);
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
        Schema::dropIfExists('orcamento_itens');
    }
};
