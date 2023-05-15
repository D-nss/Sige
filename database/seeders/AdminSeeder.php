<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'André Adilson Moreira',
            'email' => 'aadilson@unicamp.br',
            'unidade_id' => 42, //DTIC
            'ativo' => true,
        ])->assignRole('super', 'admin', 'gr_dtic');

        User::create([
            'name' => 'Evandro Oliveira',
            'email' => 'evanoliv@unicamp.br',
            'unidade_id' => 42, //DTIC
            'ativo' => true,
        ])->assignRole('super', 'admin', 'gr_dtic');

        User::create([
            'name' => 'Hilton Cesar Ribeiro',
            'email' => 'hiltoncr@unicamp.br',
            'unidade_id' => 42, //DTIC
            'ativo' => true,
        ])->assignRole('super', 'admin', 'gr_dtic');
    }
}
