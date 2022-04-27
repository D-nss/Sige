<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModeloCronogramaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modelo_cronograma')->delete();
        
        \DB::table('modelo_cronograma')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            1 => 
            array (
                'id' => 2,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            2 => 
            array (
                'id' => 3,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            3 => 
            array (
                'id' => 4,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Término dos projetos',
                'dt_input' => 'dt_termino_projetos',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
        ));
        
        
    }
}