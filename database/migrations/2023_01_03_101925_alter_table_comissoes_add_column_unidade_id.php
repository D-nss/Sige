<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Edital;
use App\Models\Unidade;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comissoes', function (Blueprint $table) {
            $table->foreignIdFor(Edital::class)->nullable()->change();
            $table->foreignIdFor(Unidade::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comissoes', function (Blueprint $table) {
            $table->dropColumn('unidade_id');
        });
    }
};
