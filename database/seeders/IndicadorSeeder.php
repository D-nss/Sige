<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicadores')->insert([
            [
            'indicador' => 'Número de atividades culturais da unidade - vigentes no ano (desconsiderar os financiados pela Proec)',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - poder publico - area de extensão',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de programas de extensão da unidade - vigentes no ano (desconsiderar os financiados pela Proec)',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - poder publico - prestação de serviços',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de extensão da unidade - vigentes no ano (desconsiderar os financiados pela Proec)',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - poder publico - projeto de pesquisa',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços da unidade - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - poder publico - programa/projeto de extensão universitária',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de programas de extensão da unidade com o poder público - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - empresas - area de extensão',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de extensão da unidade com o poder público - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  -empresas - prestação de serviços',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços da unidade para o poder público  - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  -empresas- projeto de pesquisa',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de programas de extensão da unidade com empresas - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - empresas - programa/projeto de extensão universitária',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de extensão da unidade com empresas  - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  -  terceiro setor - area de extensão',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços da unidade para empresas  - vigentes no ano',
            'descricao_indicador' => ' Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - terceiro setor- prestação de serviço',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de programas de extensão da unidade com o terceiro setor - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior - terceiro setor-  projeto de pesquisa',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de extensão da unidade com o terceiro setor - vigentes no ano',
            'descricao_indicador' => 'Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior  - terceiro setor - programa//projeto de extensão universitária',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços da unidade para o terceiro setor  - vigentes no ano',
            'descricao_indicador' => '',
            'item_planes' => '1.01 -  Número de projetos desenvolvidos com a comunidade no ano de referência/ Número de projetos no ano anterior'
            ],
            [
            'indicador' => 'Número de participantes em eventos artísticos e culturais (incluir eventos esportivos, competições de negócios, tecnológicos, etc.) organizados pela unidade',
            'descricao_indicador' => 'Número de participantes eventos artísticos-culturias (incluir artísticos-culturais  /total de vagas disponíveis',
            'item_planes' => '1.02 - TX de participação em eventos  - por parte do público externo: (artisticos/culturais e divulgação científica)'
            ],
            [
            'indicador' => 'Total de vagas disponíveis em eventos artísticos e culturais organizados pela unidade',
            'descricao_indicador' => 'Número de participantes eventos divulgação científica/toral de vagas disponíveis',
            'item_planes' => '1.02 - TX de participação em eventos  - por parte do público externo: (artisticos/culturais e divulgação científica)'
            ],
            [
            'indicador' => 'Número de participantes em eventos de divulgação científica organizados pela unidade',
            'descricao_indicador' => 'Número de participantes eventos divulgação científica/toral de vagas disponíveis',
            'item_planes' => '1.02 - TX de participação em eventos  - por parte do público externo: (artisticos/culturais e divulgação científica)'
            ],
            [
            'indicador' => 'Total de vagas disponíveis em eventos de divulgação científica organizados pela unidade',
            'descricao_indicador' => 'Total de participantes (comunidade externa) em eventos artisticos-culturais ano referência / Total de participantes (comunidade externa)',
            'item_planes' => '1.02 - TX de participação em eventos  - por parte do público externo: (artisticos/culturais e divulgação científica)'
            ],
            [
            'indicador' => 'Total de participantes da comunidade externa em eventos artisticos-culturais organizados pela unidade',
            'descricao_indicador' => 'Total de participantes (comunidade externa) em eventos de divulgação cintífica / Total de participantes (comunidade externa)',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de participantes da comunidade externa em eventos de divulgação cintífica organizados pela unidade',
            'descricao_indicador' => 'Total de eventos pagos artísticos no ano de referência/ total de eventos pagos artísticos no ano anterior)',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de eventos artísticos e culturais  gratuitos organizados pela unidade',
            'descricao_indicador' => 'Total de eventos pagos culturais no ano de referência/ total de eventos  pagos culturais no ano anterior',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de eventos artísticos e culturais pagos  (não gratuitos) organizados pela unidade',
            'descricao_indicador' => 'Total de eventos gratuitos artísticos no ano de referência/ total de eventos gratuitos artísticos no ano anterior) ',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de eventos de divulgação científica gratuitos organizados pela unidade',
            'descricao_indicador' => 'Total de eventos gratuitos culturais no ano de referência/ total de eventos  gratuitos culturais no ano anterior',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de eventos de divulgação científica pagos  (não gratuitos) organizados pela unidade',
            'descricao_indicador' => '',
            'item_planes' => '1.03 - Tx de participantes: (total de participantes (comunidade externa) em eventos ano referência/ (total de participantes (comunidade externa) em eventos ano anterior) - estratificar artísticos, culturais e de divulgação científica'
            ],
            [
            'indicador' => 'Total de vagas (número máximo oferecido) em cursos de extensão da unidade',
            'descricao_indicador' => 'Taxa de participantes em cursos de extensão = Total de vagas (número máximo oferecido) /Total de Alunos matriculados em cursos de extensão',
            'item_planes' => '1.04 - Taxa de participação em cursos de extensão'
            ],
            [
            'indicador' => 'Total de alunos matriculados em cursos de extensão da unidade',
            'descricao_indicador' => 'Taxa de cursos de extensão = Total de cursos realizados no ano referencia / Total de cursos de extensão realizados no ano anterior',
            'item_planes' => '1.04 - Taxa de participação em cursos de extensão'
            ],
            [
            'indicador' => 'Total de cursos realizados pela unidade no ano',
            'descricao_indicador' => '',
            'item_planes' => '1.05 - Taxa cursos extensão'
            ],
            [
            'indicador' => 'Total de participantes em cursos de extensão da unidade',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Total de bolsistas em cursos de extensão da unidade - bolsistas total ou parcial',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Total de pagantes em cursos de extensão da unidade',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Total de participantes em cursos de extensão gratuitos da unidade',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Total de participantes em cursos de extensão da unidade estratiticado por perfil étnico-racial',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Total de participantes em cursos de extensão da unidade estratiticado por perfil social',
            'descricao_indicador' => '',
            'item_planes' => '1.06 - Tx de participantes: (total de participantes em cursos de extensão ano referência/ total de participantes em cursos de extensão ano anterior) - estratificar perfil etnico-racial e social, participantes com bolsas/gratuitos'
            ],
            [
            'indicador' => 'Numero de docentes da unidade',
            'descricao_indicador' => 'Numero absoluto de docentes/comitês de discussão de políticas públicas',
            'item_planes' => '1.07 - Número absoluto de docentes/servidores que são membros de órgãos externos ou em comissões consultoras/comitês de discussão de políticas públicas (por ano)'
            ],
            [
            'indicador' => 'Numero de servidores não docentes da unidade',
            'descricao_indicador' => 'Numero absoluto de docentes/comitês de discussão de políticas públicas',
            'item_planes' => '1.07 - Número absoluto de docentes/servidores que são membros de órgãos externos ou em comissões consultoras/comitês de discussão de políticas públicas (por ano)'
            ],
            [
            'indicador' => 'Total de servidores (docentes e não docentes) que são membros de órgãos externos ou em comissões consultoras',
            'descricao_indicador' => 'Numero absoluto de docentes/comitês de discussão de políticas públicas',
            'item_planes' => '1.07 - Número absoluto de docentes/servidores que são membros de órgãos externos ou em comissões consultoras/comitês de discussão de políticas públicas (por ano)'
            ],
            [
            'indicador' => 'Total de servidores (docentes e não docentes) que são membros comitês de discussão de políticas públicas',
            'descricao_indicador' => 'Numero absoluto de docentes/ servidores que são membros de órgãos externos ou em comissões consultoras',
            'item_planes' => '1.07 - Número absoluto de docentes/servidores que são membros de órgãos externos ou em comissões consultoras/comitês de discussão de políticas públicas (por ano)'
            ],
            [
            'indicador' => ' %de estudantes por região = Total de Alunos Matriculados por região Norte-Sul-Nordeste-Centro Oeste-Sudeste / Alunos matriculados',
            'descricao_indicador' => '% de estudantes por região = Total de Alunos Matriculados por região Norte-Sul-Nordeste-Centro Oeste-Sudeste / Alunos matriculados',
            'item_planes' => '1.08 - % estudantes por região = número total de matriculados de outras regiões/ total de matriculados extensão *estratificar por curso/unidade/região'
            ],
            [
            'indicador' => '% de estudantes por Cursos = Total de Alunos Matriculados por Curso / Alunos matriculados',
            'descricao_indicador' => '% de estudantes por Cursos = Total de Alunos Matriculados por Curso / Alunos matriculados',
            'item_planes' => '1.08 - % estudantes por região = número total de matriculados de outras regiões/ total de matriculados extensão *estratificar por curso/unidade/região'
            ],
            [
            'indicador' => '% de estudantes por unidade = Total de Alunos Matriculados por Unidade / Alunos matriculados',
            'descricao_indicador' => '% de estudantes porunidade = Total de Alunos Matriculados por Unidade / Alunos matriculados',
            'item_planes' => '1.08 - % estudantes por região = número total de matriculados de outras regiões/ total de matriculados extensão *estratificar por curso/unidade/região'
            ],
            [
            'indicador' => 'Volume de recursos de programas de extensão no ano referência',
            'descricao_indicador' => 'Volume de recursos de Projetos de extensão no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Volume total de recursos executados dos projetos de extensão da unidade (exceto apoio Proec)',
            'descricao_indicador' => 'Volume de recursos de atividades de consultoria de extensão no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Volume de recursos de atividades de consultoria e assessoria de extensão no ano referência (empresas, setor público e terceiro setor)',
            'descricao_indicador' => 'Volume de recursos de programas de extensão no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Volume de recursos de atividades culturais no ano referência',
            'descricao_indicador' => 'Volume de recursos de programas de extensão no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Volume de recursos de eventos de divulgação científica',
            'descricao_indicador' => 'Volume de recursos de Projetos de extensão no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Volume de recursos de Cursos de extensão no ano referência',
            'descricao_indicador' => 'Volume de recursos de atividades culturais no ano referência/ ano anterior',
            'item_planes' => '1.09 - Taxa de recursos para extensão = Volume de recursos da extensão no ano referência/ ano anterior - desdobrar por fontes de recursos (cursos, projetos, atividades de consultoria e assessoria, atividades culturais e programas)'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com programas de extensão',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com projetos de extensão',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com eventos artísticos e culturais',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com eventos de divulgação científica',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com coordenação de cursos de extensão',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com o ensino em cursos de extensão',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de docentes envolvidos com prestação de serviços',
            'descricao_indicador' => '% de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd',
            'item_planes' => '1.10 - % de docentes envolvidos com extensão = Número de docentes envolvidos com extensão /número total de docentes - estratificar por cursos de extensão, prestação de serviços (consultoria e assessoria), projetos de extensão comunitária e cultura, por unidd'
            ],
            [
            'indicador' => 'Número de discentes de graduação envolvidos na organização de atividades culturais',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de pós-graduação envolvidos na organização de atividades culturais',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de graduação envolvidos com programas ou projetos de extensão',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de pós-graduação envolvidos com programas ou projetos de extensão',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de graduação envolvidos com prestação de serviços',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de pós-graduação envolvidos com prestação de serviços',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de graduação envolvidos na organização de eventos de divulgação científica',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de discentes de pós-graduação envolvidos na organização de eventos de divulgação científica',
            'descricao_indicador' => '% de discentes envolvidos na extensão = Número de discentes envolvidos nas ações de extensão (grad. e pós)/número total de discentes estraf por unidd e grad. e pós)',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de atividades culturais com participação de discentes de graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de atividades culturais com participação de discentes de pós-graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de programas e projetos de extensão com participação de discentes de graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de programas e projetos de extensão com participação de discentes de pós-graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços com participação de discentes de graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de projetos de prestação de serviços com participação de discentes de pós-graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de programas e projetos de extensão com participação de discentes de graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de programas e projetos de extensão com participação de discentes de pós-graduação',
            'descricao_indicador' => '% de Projetos com participação dos estudantes (Grad/PosGrad)/total de projetos de extensão',
            'item_planes' => '1.11 - % de discentes envolvidos com extensão'
            ],
            [
            'indicador' => 'Número de ações de extensão relacionados às tecnologias (inovações) sociais envolvendo terceiro setor - cursos e eventos',
            'descricao_indicador' => 'Número de projetos relacionados às tecnologias (inovações) sociais envolvendo terceiro setor. (referência Cáp. 8 AI)2',
            'item_planes' => '1.13 - Número de projetos relacionados às tecnologias (inovações) sociais envolvendo terceiro setor'
            ],
            [
            'indicador' => 'Número de ações de extensão relacionados às tecnologias (inovações) sociais envolvendo terceiro setor - exceto cursos e eventos',
            'descricao_indicador' => 'Número de projetos relacionados às tecnologias (inovações) sociais envolvendo terceiro setor. (referência Cáp. 8 AI)2',
            'item_planes' => '1.13 - Número de projetos relacionados às tecnologias (inovações) sociais envolvendo terceiro setor'
            ],
    ]);
    }
}
