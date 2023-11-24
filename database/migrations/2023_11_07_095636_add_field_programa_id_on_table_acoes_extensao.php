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
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->unsignedBigInteger('comite_user_id')->nullable();
            $table->string('parecer_comite', 1000)->nullable();
            $table->string('aceite_comite', 10)->nullable();
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
            $table->dropColumn('programa_id');
            $table->dropColumn('comite_user_id');
            $table->dropColumn('parecer_comite');
            $table->dropColumn('aceite_comite');
        });
    }
};
