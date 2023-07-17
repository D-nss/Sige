<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TipoPublico;

class TipoPublicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            'Funcionário UNICAMP',
            'FUNCAMP – Funcionário',
            'FUNCAMP – Estagiário',
            'FUNCAMP - Bolsista',
            'Aluno UNICAMP',
            'Estudante Especial',
            'ALUNO DE COLEGIO TECNICO',
            'ALUNO DA EXTECAMP',
            'USUARIO CONVIDADO',
            'COLABORADOR EXTERNO DAC',
            'PROFESSOR/PESQUISADOR VISITANTE',
            'ESPECIALISTA VISITANTE',
            'EXTERNOS',
            'EXTERNOS TEMPORARIO',
            'EXTERNOS PDU',
            'EXTERNOS RESTRITO AUTENTICACAO',
            'EXTERNOS RESTRITO AUTENTICACAO'
        ];

        foreach ($tipos as $tipo) {
             TipoPublico::create(['descricao' => $tipo]);
        }
    }
}
