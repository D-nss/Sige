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
            $table->bigInteger('avaliacao_conext_user_id')->nullable();
            $table->string('status_avaliacao_conext', 250)->nullable();
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
            $table->dropColumn('avaliacao_conext_user_id');
            $table->dropColumn('status_avaliacao_conext', 250);
        });
    }
};
