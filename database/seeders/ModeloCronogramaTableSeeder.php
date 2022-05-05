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
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            4 => 
            array (
                'id' => 5,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            5 => 
            array (
                'id' => 6,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            6 => 
            array (
                'id' => 7,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data de término da data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
        ));
        
        
    }
}