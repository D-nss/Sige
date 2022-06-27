<?php

namespace Database\Seeders;

use App\Models\GrauEnvolvimentoEquipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrauEnvolvimentoEquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $graus = [
            'Não conhecem a comunidade',
            'Conhecem a comunidade',
            'Já houve contato com a comunidade',
            'Já houve outro projeto da equipe junto a comunidade',
            'Estão totalmente integrados com a comunidade',
            'Existe um documento de aceitação do projeto pela comunidade',
            'Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto'
        ];

        foreach ($graus as $grau) {
             GrauEnvolvimentoEquipe::create(['descricao' => $grau]);
        }
    }
}
