<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comissao;

class ComissaoConextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comissao::create([
            'nome' => 'Comissão Conext',
            'atribuicao' => 'Conext'
        ]);
    }
}
