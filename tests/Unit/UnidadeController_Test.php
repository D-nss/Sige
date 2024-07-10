<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UnidadeController;
use App\Models\Unidade;
use App\Http\Requests\StoreUnidadeRequest;
use App\Http\Requests\UpdateUnidadeRequest;



class UnidadeController_Test extends TestCase
{
    //iremos testar as principais funções do UnidadeController
    public function test_store(){

        //testamos a função store(), para isso cria-se uma unidade e a guarda no banco de dados

        $request = new StoreUnidadeRequest(['nome' => 'UnidadeTeste', 
                                'sigla' => 'UT']);

        $contoller = new UnidadeController;
        $contoller->store($request);

        $model = new Unidade();
        $unidade = $model->where('nome', '=', 'UnidadeTeste')
                      ->where('sigla', '=', 'UT')
                      ->first();

        //conferimos se a unidade criada existe no banco de dados

        $this->assertNotEmpty($unidade);
    }

    public function test_update(){

        //testamos a função update(), para isso modifica-se uma unidade e verifica se ela existe no banco de dados da forma alterada, além de verificfar se sua forma antiga não existe mais no banco de dados

        $request = new UpdateUnidadeRequest(['nome' => 'UnidadeTeste2', 
                                'sigla' => 'UT2']);

        $contoller = new UnidadeController;

        $model = new Unidade();
        $unidade = $model->where('nome', '=', 'UnidadeTeste')
                        ->where('sigla', '=', 'UT')
                        ->first();

        $contoller->update($request, $unidade);

        $unidade = $model->where('nome', '=', 'UnidadeTeste')
                        ->where('sigla', '=', 'UT')
                        ->first();

        $this->assertEmpty($unidade);

        $unidade = $model->where('nome', '=', 'UnidadeTeste2')
                        ->where('sigla', '=', 'UT2')
                        ->first();

        $this->assertNotEmpty($unidade);
    }

    public function test_destroy(){

        //testamos a função destroy(), pega-se a unidade criado em test_store() e tenta removela do banco de dados

        $contoller = new UnidadeController;
        $model = new Unidade();
        $unidade = $model->where('nome', '=', 'UnidadeTeste2')
                      ->where('sigla', '=', 'UT2')
                      ->first();

        $contoller->destroy($unidade);

        $unidade = $model->where('nome', '=', 'UnidadeTeste2')
                      ->where('sigla', '=', 'UT2')
                      ->first();

        $this->assertEmpty($unidade);

    }
}