<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item')->delete();
        
        \DB::table('item')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Escritório/Papelaria',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:07',
                'updated_at' => '2022-05-02 12:44:08',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Informática',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:10',
                'updated_at' => '2022-05-02 12:44:11',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Fotografia/filmagem/arquivo',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:12',
                'updated_at' => '2022-05-02 12:44:12',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Esportes',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:14',
                'updated_at' => '2022-05-02 12:44:14',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Didático',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:15',
                'updated_at' => '2022-05-02 12:44:15',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Gêneros Alimentícios',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:16',
                'updated_at' => '2022-05-02 12:44:16',
            ),
            6 => 
            array (
                'id' => 7,
                'nome' => 'Equipamento Proteção Individual',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:17',
                'updated_at' => '2022-05-02 12:44:17',
            ),
            7 => 
            array (
                'id' => 8,
                'nome' => 'Alimentação Pronta',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:18',
                'updated_at' => '2022-05-02 12:44:18',
            ),
            8 => 
            array (
                'id' => 9,
                'nome' => 'Odontológico/hospitalar/ambulatorial',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:19',
                'updated_at' => '2022-05-02 12:44:20',
            ),
            9 => 
            array (
                'id' => 10,
                'nome' => 'Produtos químicos, reagentes e assemelhados',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:21',
                'updated_at' => '2022-05-02 12:44:21',
            ),
            10 => 
            array (
                'id' => 11,
                'nome' => 'Básico de construção/Elétrico/Hidráulico',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:22',
                'updated_at' => '2022-05-02 12:44:22',
            ),
            11 => 
            array (
                'id' => 12,
                'nome' => 'Correios',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:24',
                'updated_at' => '2022-05-02 12:44:24',
            ),
            12 => 
            array (
                'id' => 13,
                'nome' => 'Vestuários',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:25',
                'updated_at' => '2022-05-02 12:44:26',
            ),
            13 => 
            array (
                'id' => 14,
                'nome' => 'Outros Materiais de consumo',
                'tipo_item_id' => 1,
                'created_at' => '2022-05-02 12:44:27',
                'updated_at' => '2022-05-02 12:44:28',
            ),
            14 => 
            array (
                'id' => 15,
            'nome' => 'Locomoção (transp. Terrestre/aéreo/náutico)',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:29',
                'updated_at' => '2022-05-02 12:44:30',
            ),
            15 => 
            array (
                'id' => 16,
                'nome' => 'Táxi e assemelhados.',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:31',
                'updated_at' => '2022-05-02 12:44:32',
            ),
            16 => 
            array (
                'id' => 17,
                'nome' => 'Combustíveis',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:33',
                'updated_at' => '2022-05-02 12:44:34',
            ),
            17 => 
            array (
                'id' => 18,
                'nome' => 'Gráfica / Impressão/Livros/Apostilas/folders',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:36',
                'updated_at' => '2022-05-02 12:44:36',
            ),
            18 => 
            array (
                'id' => 19,
            'nome' => 'Pequena Monta (pequenos serviços/atividades de terceiros)',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:34',
                'updated_at' => '2022-05-02 12:44:35',
            ),
            19 => 
            array (
                'id' => 20,
                'nome' => 'Locação de veículos',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:38',
                'updated_at' => '2022-05-02 12:44:39',
            ),
            20 => 
            array (
                'id' => 21,
                'nome' => 'Licenças de software',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:42',
                'updated_at' => '2022-05-02 12:44:42',
            ),
            21 => 
            array (
                'id' => 22,
                'nome' => 'Auxílio Financeiro a Alunos',
                'tipo_item_id' => 2,
                'created_at' => '2022-05-02 12:44:43',
                'updated_at' => '2022-05-02 12:44:44',
            ),
            22 => 
            array (
                'id' => 23,
                'nome' => 'Equipamentos eletrônicos / telecomunicações',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:44',
                'updated_at' => '2022-05-02 12:44:45',
            ),
            23 => 
            array (
                'id' => 24,
                'nome' => 'Utensílios',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:46',
                'updated_at' => '2022-05-02 12:44:46',
            ),
            24 => 
            array (
                'id' => 25,
                'nome' => 'Equipamentos de Informática',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:47',
                'updated_at' => '2022-05-02 12:44:47',
            ),
            25 => 
            array (
                'id' => 26,
                'nome' => 'Equipamento médico hospitalar',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:48',
                'updated_at' => '2022-05-02 12:44:48',
            ),
            26 => 
            array (
                'id' => 27,
                'nome' => 'Equipamento de Esporte / Ginástica /Diversão',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:49',
                'updated_at' => '2022-05-02 12:44:50',
            ),
            27 => 
            array (
                'id' => 28,
                'nome' => 'Mobiliários e Utensílios',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:51',
                'updated_at' => '2022-05-02 12:44:52',
            ),
            28 => 
            array (
                'id' => 29,
                'nome' => 'Equipamento de Cozinha',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:53',
                'updated_at' => '2022-05-02 12:44:54',
            ),
            29 => 
            array (
                'id' => 30,
                'nome' => 'Equipamentos e instrumentos musicais',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:44:54',
                'updated_at' => '2022-05-02 12:45:04',
            ),
            30 => 
            array (
                'id' => 31,
                'nome' => 'Equipamentos e ferramentas',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:45:00',
                'updated_at' => '2022-05-02 12:45:01',
            ),
            31 => 
            array (
                'id' => 32,
                'nome' => 'Outros equipamentos',
                'tipo_item_id' => 3,
                'created_at' => '2022-05-02 12:45:02',
                'updated_at' => '2022-05-02 12:45:03',
            ),
        ));
        
        
    }
}