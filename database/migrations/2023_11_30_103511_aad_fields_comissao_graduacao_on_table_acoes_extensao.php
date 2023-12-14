<?php

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
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->bigInteger('comissao_graduacao_user_id')->nullable();
            $table->string('parecer_comissao_graduacao', 1000)->nullable();
            $table->string('status_comissao_graduacao', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acoes_extensao', function (Blueprint $table) {
            $table->dropColumn('comissao_graduacao_user_id');
            $table->dropColumn('parecer_comissao_graduacao');
            $table->dropColumn('status_comissao_graduacao');
        });
    }
};
