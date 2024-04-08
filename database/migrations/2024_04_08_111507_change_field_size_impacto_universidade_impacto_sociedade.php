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
            $table->text('impactos_universidade', 10000)->change();
            $table->text('impactos_sociedade', 10000)->change();
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
            $table->string('impactos_universidade', 2500)->change();
            $table->string('impactos_universidade', 2500)->change();
            
        });
    }
};
