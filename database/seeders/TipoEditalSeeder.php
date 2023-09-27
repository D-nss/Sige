<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoEditalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos_editais')->delete();
        
        \DB::table('tipos_editais')->insert(
            array (
                0 => 
                array (
                    'id' => 1,
                    'descricao' => 'Ações Afirmativas',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                1 => 
                array (
                    'id' => 2,
                    'descricao' => 'Fluxo Contínuo',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                2 => 
                array (
                    'id' => 3,
                    'descricao' => 'Colégios',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                3 => 
                array (
                    'id' => 4,
                    'descricao' => 'Cultura',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                4 => 
                array (
                    'id' => 5,
                    'descricao' => 'EAD',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                5 => 
                array (
                    'id' => 6,
                    'descricao' => 'Inovação e Empreendedorismo',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                6 => 
                array (
                    'id' => 7,
                    'descricao' => 'PEX',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
                7 => 
                array (
                    'id' => 8,
                    'descricao' => 'Saberes Indígenas',
                    'created_at' => '2022-09-22 16:43:00',
                    'updated_at' => '2022-09-22 16:43:00',
                ),
            )
        );
    }
}
