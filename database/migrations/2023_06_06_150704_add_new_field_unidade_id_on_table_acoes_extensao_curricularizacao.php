<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Unidade;
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
        Schema::table('acoes_extensao_curricularizacao', function (Blueprint $table) {
            $table->foreignIdFor(Unidade::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acoes_extensao_curricularizacao', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('unidade_id');
        });
    }
};
