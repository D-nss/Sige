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
        Schema::table('evento_inscritos', function (Blueprint $table) {
            $table->string('nome_social')->nullable();
            $table->string('etnico_racial')->nullable();
            $table->char('deficiencia', 4)->nullable();
            $table->string('desc_deficiencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_inscritos', function (Blueprint $table) {
            $table->dropColumn('nome_social');
            $table->dropColumn('etnico_racial');
            $table->dropColumn('deficiencia', 4);
            $table->dropColumn('desc_deficiencia');
        });
    }
};
