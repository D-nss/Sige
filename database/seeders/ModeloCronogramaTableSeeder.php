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
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            7 => 
            array (
                'id' => 8,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            8 => 
            array (
                'id' => 9,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            9 => 
            array (
                'id' => 10,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            10 => 
            array (
                'id' => 11,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            11 => 
            array (
                'id' => 12,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            12 => 
            array (
                'id' => 13,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            13 => 
            array (
                'id' => 14,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            14 => 
            array (
                'id' => 15,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Inicio Execução Programa',
                'dt_input' => 'dt_inicio_execucao_programa',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução do programa não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            15 => 
            array (
                'id' => 16,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao_programa',
                'validate' => 'dt_inicio_execucao_programa',
                'msg_erro' => 'A data de fim da execução do programa não pode ser menor que a data de inicio da execução do programa',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            16 => 
            array (
                'id' => 17,
                'tipo_edital' => 'PEX',
                'dt_label' => 'Data Fim Relatório Final Programa',
                'dt_input' => 'dt_fim_relatorio_programa',
                'validate' => 'dt_fim_execucao_programa',
                'msg_erro' => 'A data de fim do relatorio final do programa não pode ser menor que a data da execução do programa',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            //ações afirmativas
            17 => 
            array (
                'id' => 18,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            18 => 
            array (
                'id' => 19,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            19 => 
            array (
                'id' => 20,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            20 => 
            array (
                'id' => 21,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            21 => 
            array (
                'id' => 22,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            22 => 
            array (
                'id' => 23,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            23 => 
            array (
                'id' => 24,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            24 => 
            array (
                'id' => 25,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            25 => 
            array (
                'id' => 26,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            26 => 
            array (
                'id' => 27,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            27 => 
            array (
                'id' => 28,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            28 => 
            array (
                'id' => 29,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            29 => 
            array (
                'id' => 30,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            30 => 
            array (
                'id' => 31,
                'tipo_edital' => 'Acoes Afirmativas',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),

            //Indígenas
            31 => 
            array (
                'id' => 32,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            32 => 
            array (
                'id' => 33,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            33 => 
            array (
                'id' => 34,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            34 => 
            array (
                'id' => 35,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            35 => 
            array (
                'id' => 36,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            36 => 
            array (
                'id' => 37,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            37 => 
            array (
                'id' => 38,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            38 => 
            array (
                'id' => 39,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            39 => 
            array (
                'id' => 40,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            40 => 
            array (
                'id' => 41,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            41 => 
            array (
                'id' => 42,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            42 => 
            array (
                'id' => 43,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            43 => 
            array (
                'id' => 44,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            44 => 
            array (
                'id' => 45,
                'tipo_edital' => 'Saberes Indígenas',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            //Colégios
            45 => 
            array (
                'id' => 46,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            46 => 
            array (
                'id' => 47,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            47 => 
            array (
                'id' => 48,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            48 => 
            array (
                'id' => 49,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            49 => 
            array (
                'id' => 50,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            50 => 
            array (
                'id' => 51,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            51 => 
            array (
                'id' => 52,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            52 => 
            array (
                'id' => 53,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            53 => 
            array (
                'id' => 54,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            54 => 
            array (
                'id' => 55,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            55 => 
            array (
                'id' => 56,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            56 => 
            array (
                'id' => 57,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            57 => 
            array (
                'id' => 58,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            58 => 
            array (
                'id' => 59,
                'tipo_edital' => 'Colégios',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),

            //Inovação e Empreendedorismo
            59 => 
            array (
                'id' => 60,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            60 => 
            array (
                'id' => 61,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            61 => 
            array (
                'id' => 62,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            62 => 
            array (
                'id' => 63,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            63 => 
            array (
                'id' => 64,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            64 => 
            array (
                'id' => 65,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            65 => 
            array (
                'id' => 66,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            66 => 
            array (
                'id' => 67,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            67 => 
            array (
                'id' => 68,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            68 => 
            array (
                'id' => 69,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            69 => 
            array (
                'id' => 70,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            70 => 
            array (
                'id' => 71,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            71 => 
            array (
                'id' => 72,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            72 => 
            array (
                'id' => 73,
                'tipo_edital' => 'Inovação e Empreendedorismo',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            //Cultura
            73 => 
            array (
                'id' => 74,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            74 => 
            array (
                'id' => 75,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            75 => 
            array (
                'id' => 76,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            76 => 
            array (
                'id' => 77,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            77 => 
            array (
                'id' => 78,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            78 => 
            array (
                'id' => 79,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            79 => 
            array (
                'id' => 80,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            80 => 
            array (
                'id' => 81,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            81 => 
            array (
                'id' => 82,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            82 => 
            array (
                'id' => 83,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            83 => 
            array (
                'id' => 84,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            84 => 
            array (
                'id' => 85,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            85 => 
            array (
                'id' => 86,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            86 => 
            array (
                'id' => 87,
                'tipo_edital' => 'Cultura',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            //EAD
            87 => 
            array (
                'id' => 88,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Divulgação',
                'dt_input' => 'dt_divulgacao',
                'validate' => '',
                'msg_erro' => '',
                'created_at' => '2022-04-12 14:03:38',
                'updated_at' => '2022-04-12 14:03:39',
            ),
            88 => 
            array (
                'id' => 89,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Início das Inscrições',
                'dt_input' => 'dt_inscricao',
                'validate' => 'dt_divulgacao',
                'msg_erro' => 'A data de inscrição não pode ser menor que a data de divulgação',
                'created_at' => '2022-04-12 14:03:36',
                'updated_at' => '2022-04-12 14:03:37',
            ),
            89 => 
            array (
                'id' => 90,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Termino das Inscrições',
                'dt_input' => 'dt_termino_inscricao',
                'validate' => 'dt_inscricao',
                'msg_erro' => 'A data de termino das inscrições não pode ser menor que a data de inscrição',
                'created_at' => '2022-04-12 14:05:42',
                'updated_at' => '2022-04-12 14:05:43',
            ),
            90 => 
            array (
                'id' => 91,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Organização por Área temática',
                'dt_input' => 'dt_org_tematica',
                'validate' => 'dt_termino_inscricao',
                'msg_erro' => 'A data de organização por área temática não pode ser menor que a data  de término das inscrições',
                'created_at' => '2022-04-12 14:08:54',
                'updated_at' => '2022-04-12 14:08:54',
            ),
            91 => 
            array (
                'id' => 92,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Término Organização por Área Temática',
                'dt_input' => 'dt_termino_org_tematica',
                'validate' => 'dt_org_area_tematica',
                'msg_erro' => 'A data  término de organização por área temática não poder ser menor que a  data inicial da organizção por área temática',
                'created_at' => '2022-05-03 09:52:28',
                'updated_at' => '2022-05-03 09:52:29',
            ),
            92 => 
            array (
                'id' => 93,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data de Inicio de Análise dos Pareceristas',
                'dt_input' => 'dt_pareceristas',
                'validate' => 'dt_termino_org_area_tematica',
                'msg_erro' => 'A data de Inicio da análise dos pareceristas não pode ser menor que a data de término da organização por área temática',
                'created_at' => '2022-05-03 10:02:32',
                'updated_at' => '2022-05-03 10:02:33',
            ),
            93 => 
            array (
                'id' => 94,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Término de Análise dos Pareceristas',
                'dt_input' => 'dt_termino_pareceristas',
                'validate' => 'dt_pareceristas',
                'msg_erro' => 'A data de término da análise dos pareceristas não pode ser menor que a data inicio de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            94 => 
            array (
                'id' => 95,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Divulgação Preliminar',
                'dt_input' => 'dt_divulgacao_previa',
                'validate' => 'dt_termino_pareceristas',
                'msg_erro' => 'A data de divulgação preliminar não pode ser menor que a data de término de análise dos pareceristas',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            95 => 
            array (
                'id' => 96,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Interposição Recurso',
                'dt_input' => 'dt_recurso',
                'validate' => 'dt_divulgacao_previa',
                'msg_erro' => 'A data de incio da interposição de recurso não pode ser menor que a data de divulgação preliminar',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            96 => 
            array (
                'id' => 97,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Fim Interposição Recurso',
                'dt_input' => 'dt_termino_recurso',
                'validate' => 'dt_recurso',
                'msg_erro' => 'A data fim da interposição de recurso não pode ser menor que a data de inicio da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            97 => 
            array (
                'id' => 98,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Resultado Final',
                'dt_input' => 'dt_resultado',
                'validate' => 'dt_termino_recurso',
                'msg_erro' => 'A data de resultado final não pode ser menor que a data fim da interposição de recurso',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            98 => 
            array (
                'id' => 99,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Inicio Execução Projeto',
                'dt_input' => 'dt_inicio_execucao',
                'validate' => 'dt_resultado',
                'msg_erro' => 'A data de inicio da execução não pode ser menor que a data do resultado final',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            99 => 
            array (
                'id' => 100,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Fim Execução Projeto',
                'dt_input' => 'dt_fim_execucao',
                'validate' => 'dt_inicio_execucao',
                'msg_erro' => 'A data de fim da execução não pode ser menor que a data de inicio da execução',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),
            100 => 
            array (
                'id' => 101,
                'tipo_edital' => 'EAD',
                'dt_label' => 'Data Fim Relatório Final',
                'dt_input' => 'dt_fim_relatorio',
                'validate' => 'dt_fim_execucao',
                'msg_erro' => 'A data de fim do relatorio final não pode ser menor que a data da execução do projeto',
                'created_at' => '2022-05-03 10:02:34',
                'updated_at' => '2022-05-03 10:02:34',
            ),     
        ));
        
        
    }
}