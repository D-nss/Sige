<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Papeis do Sistema. Adicionar conforme o decorrer do desenvolvimento
        $roles = [
            'super',
            'admin',
            'edital-administrador',
            'edital-analista',
            'edital-avaliador',
            'edital-coordenador',
            'indicadores-admin',
            'indicadores-user',
            'acoes-extensao-user',
            'acoes-extensao-admin'
        ];

        foreach ($roles as $role) {
             Role::create(['name' => $role, 'guard_name' => 'web_user']);
        }
    }
}
