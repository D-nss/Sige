<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(30)->create();
        // \App\Models\User::create([
        //     'name' => 'Usuário Administrador',
        //     'email' => 'admin@admin.com',
        //     'unidade_id' => 39,
        //     'ativo' => true,
        //     'email_verified_at' => now(),
        //     //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10)
        // ]);

        //Permissões (Permissions)
         $this->call(PermissionSeeder::class);

        //Papeis (Roles)
        //$this->call(RoleSeeder::class);

        //Unidades
        //$this->call(UnidadeSeeder::class);

        //Usuários Super/Admin iniciais do sistema
        //$this->call(AdminSeeder::class);

        //Indicadores
        //$this->call(IndicadorSeeder::class);

        //Linhas de Extensão
        $this->call(LinhasExtensaoTableSeeder::class);
        //Areas Tematicas
        $this->call(AreasTematicasTableSeeder::class);

    }
}
