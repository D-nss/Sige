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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->integer("codigo_ibge");
            $table->string("nome_municipio");
            $table->integer("codigo_uf");
            $table->string("uf", 2);
            $table->string("estado");
            $table->boolean("capital");
            $table->decimal("latitude", 10, 8);
            $table->decimal("longitude", 11,8);
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
        Schema::dropIfExists('municipios');
    }
};
