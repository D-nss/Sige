<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcaoExtensaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\AcaoExtensao::factory(200)->create();
         \App\Models\AcaoExtensaoAreaTematica::factory(200)->create();
         \App\Models\AcaoExtensaoODS::factory(200)->create();
         \App\Models\AcaoExtensaoParceiro::factory(200)->create();
    }
}
