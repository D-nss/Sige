<?php

namespace Database\Seeders;

use App\Models\ObjetivoDesenvolvimentoSustentavel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjetivoDesenvolvimentoSustentavelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objetivos = [
            'Erradicação da pobreza',
            'Fome zero e agricultura sustentável',
            'Saúde e bem-estar',
            'Educação de qualidade',
            'Igualdade de gênero',
            'Água potável e saneamento',
            'Energia limpa e acessível',
            'Trabalho decente e crescimento econômico',
            'Indústria, inovação e infraestrutura',
            'Redução das desigualdades',
            'Cidades e comunidades sustentáveis',
            'Consumo e produção responsáveis',
            'Ação contra a mudança global do clima',
            'Vida na água',
            'Vida terrestre',
            'Paz, justiça e instituições eficazes',
            'Parcerias e meios de implementação'
        ];

        foreach ($objetivos as $objetivo) {
             ObjetivoDesenvolvimentoSustentavel::create(['nome' => $objetivo]);
        }
    }
}
