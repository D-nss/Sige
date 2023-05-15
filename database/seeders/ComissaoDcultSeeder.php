<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comissao;

class ComissaoDcultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comissao::create([
            [
                'nome' => 'DCULT',
                'atribuicao' => 'Avaliação',
                'unidade_id' => 44
            ],
        ]);
    }
}
