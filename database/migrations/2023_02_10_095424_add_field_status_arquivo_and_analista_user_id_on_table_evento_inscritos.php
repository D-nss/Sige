<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::table('evento_inscritos', function (Blueprint $table) {
            $table->string('status_arquivo', 50);
            $table->foreignIdFor(User::class, 'analista_user_id');
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
            $table->dropColumn('status_arquivo');
            $table->dropColumn('analista_user_id');
        });
    }
};
