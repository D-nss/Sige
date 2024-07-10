<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UserController;
use App\Models\User;
use \Illuminate\Http\Request;



class UserController_Test extends TestCase
{
    //iremos testar as principais funções do UserController

    public function test_store(){

        //testamos a função store(), para isso cria-se um usuário e o guarda no banco de dados

        $request = new Request(['name' => 'User Test', 
                                'email' => 'test@gmail.com', 
                                'unidade' => '42', 
                                'roles' => 'at_conext']);

        $contoller = new UserController;
        $contoller->store($request);

        $model = new User();
        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        //conferimos se o usuário criado existe no banco de dados

        $this->assertNotEmpty($user);
    }

    public function test_desativar(){

        //testamos a função desativar(), pega-se o usuário criado em test_store() e o desativa

        $contoller = new UserController;
        $model = new User();
        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $contoller->desativar($user);

        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->where('ativo', '=', false)
                      ->first();

        $this->assertNotEmpty($user);
    }

    public function test_ativar(){

        //testamos a função ativar(), pega-se o usuário criado em test_store() e o ativa

        $contoller = new UserController;
        $model = new User();
        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $contoller->ativar($user);

        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->where('ativo', '=', true)
                      ->first();

        $this->assertNotEmpty($user);
    }

    public function test_update(){

        //testamos a função update(), para isso modifica-se um usuário e verifica se ele existe no banco de dados da forma alterada, além de verificfar se sua forma antiga não existe mais no banco de dados

        $request = new Request(['name' => 'User Test2', 
                                'email' => 'test2@gmail.com', 
                                'unidade' => '42', 
                                'roles' => 'at_conext']);

        $contoller = new UserController;

        $model = new User();
        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $contoller->update($request, $user);

        $user = $model->where('name', '=', 'User Test')
                      ->where('email', '=', 'test@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $this->assertEmpty($user);

        $user = $model->where('name', '=', 'User Test2')
                      ->where('email', '=', 'test2@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $this->assertNotEmpty($user);
    }

    public function test_destroy(){

        //testamos a função destroy(), pega-se o usuário criado em test_store() e tenta removelo do banco de dados
        
        $contoller = new UserController;
        $model = new User();
        $user = $model->where('name', '=', 'User Test2')
                      ->where('email', '=', 'test2@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $contoller->destroy($user);

        $user = $model->where('name', '=', 'User Test2')
                      ->where('email', '=', 'test2@gmail.com')
                      ->where('unidade_id', '=', '42')
                      ->first();

        $this->assertEmpty($user);

    }

}