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
        Schema::table('evento_equipe', function (Blueprint $table) {
            $table->string('titulo_palestra', 300)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_equipe', function (Blueprint $table) {
            $table->dropColumn('titulo_palestra');
        });
    }
};
