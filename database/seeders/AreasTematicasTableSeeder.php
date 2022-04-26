<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreasTematicasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('areas_tematicas')->delete();
        
        \DB::table('areas_tematicas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Comunicação',
                'created_at' => '2022-04-22 13:38:45',
                'updated_at' => '2022-04-22 13:38:45',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Cultura',
                'created_at' => '2022-04-22 13:40:24',
                'updated_at' => '2022-04-22 13:40:24',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Direitos Humanos e Justiça',
                'created_at' => '2022-04-22 13:42:33',
                'updated_at' => '2022-04-22 13:42:33',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Educação',
                'created_at' => '2022-04-22 16:19:57',
                'updated_at' => '2022-04-22 16:19:57',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Meio Ambiente',
                'created_at' => '2022-04-22 16:20:46',
                'updated_at' => '2022-04-22 16:20:46',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Saúde',
                'created_at' => '2022-04-22 16:21:23',
                'updated_at' => '2022-04-22 16:21:23',
            ),
            6 => 
            array (
                'id' => 7,
                'nome' => 'Tecnologia e Produção',
                'created_at' => '2022-04-22 16:22:05',
                'updated_at' => '2022-04-22 16:22:05',
            ),
            7 => 
            array (
                'id' => 8,
                'nome' => 'Trabalho',
                'created_at' => '2022-04-22 16:22:13',
                'updated_at' => '2022-04-22 16:22:13',
            ),
        ));
        
        
    }
}