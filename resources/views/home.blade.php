@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')

<div class="container-fluid">

    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body"> -->
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="col mt-5 text-center">
                  <h1 class="text-secondary font-weight-bold">Seja bem vindo!</h1>
                  <h2 class="font-color-light font-weight-bold">Sistema de Informação Gestão de Extensão e Cultura</h2>
                    <img src="{{ asset('img/proec.svg') }}" alt="Proec - ExteCult" class="w-25 mt-5"/>
                  </div>
                  {{ dd(request()->user->comissaoExtensao) }}
                </div>
              </div>
          <!-- </div>
        </div>
      </div>
    </div> -->
</div>
@endsection
