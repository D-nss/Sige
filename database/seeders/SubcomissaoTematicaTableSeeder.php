<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubcomissaoTematicaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subcomissao_tematica')->delete();
        
        \DB::table('subcomissao_tematica')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Ciências da Vida: Biológicas e Saúde',
                'created_at' => '2022-05-03 15:50:09',
                'updated_at' => '2022-05-03 15:50:09',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Ciências Exatas, Engenharias e Tecnológicas',
                'created_at' => '2022-05-03 15:50:47',
                'updated_at' => '2022-05-03 15:50:47',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Ciências Humanas e Sociais, Economia e Administração',
                'created_at' => '2022-05-03 15:51:32',
                'updated_at' => '2022-05-03 15:51:32',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Colégios Técnicos',
                'created_at' => '2022-05-03 15:51:55',
                'updated_at' => '2022-05-03 15:51:55',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Centros e Núcleos',
                'created_at' => '2022-05-03 15:52:04',
                'updated_at' => '2022-05-03 15:52:04',
            ),
        ));
        
        
    }
}