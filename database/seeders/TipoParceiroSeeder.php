<?php

namespace Database\Seeders;

use App\Models\TipoParceiro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoParceiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            'Empresa com fins lucrativos',
            'Organização-Não-Governamental (ONG)',
            'Organização Social (OS)',
            'Organização da Sociedade Civil (OSC)',
            'Organização da Sociedade Civil de Interesse Público (OSCIP)',
            'Sindicatos e similares',
            'Organizações religiosas',
            'Escolas públicas',
            'Escolas ou universidades privadas',
            'Órgãos governamentais',
            'Associação de empresas',
            'Associação de bairro',
            'Outros'
        ];

        foreach ($tipos as $tipo) {
             TipoParceiro::create(['descricao' => $tipo]);
        }
    }
}
