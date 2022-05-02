<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_item')->delete();
        
        \DB::table('tipo_item')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Materiais de Consumo',
                'created_at' => '2022-05-02 12:45:16',
                'updated_at' => '2022-05-02 12:45:16',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Serviços Terceiros e Encargos',
                'created_at' => '2022-05-02 12:45:18',
                'updated_at' => '2022-05-02 12:45:18',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Equipamentos e Instalações',
                'created_at' => '2022-05-02 12:45:20',
                'updated_at' => '2022-05-02 12:45:20',
            ),
        ));
        
        
    }
}