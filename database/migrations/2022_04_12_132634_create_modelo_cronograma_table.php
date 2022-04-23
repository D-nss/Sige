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
        Schema::create('modelo_cronograma', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_edital');
            $table->string('dt_label');
            $table->string('dt_input');
            $table->string('validate');
            $table->string('msg_erro');
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
        Schema::dropIfExists('modelo_cronograma');
    }
};
