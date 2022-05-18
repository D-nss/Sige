@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')

<div class="container-fluid">

    @include('layouts._includes._status')

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h1>Seja bem vindo!</h1>
                  <h2>Sistema de Informação Gestão de Extensão e Cultura</h2>
                  <img src="{{ asset('smartadmin-4.5.1/img/proec.svg') }}" alt="Proec - ExteCult" class="" style="fill:white;"/>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
