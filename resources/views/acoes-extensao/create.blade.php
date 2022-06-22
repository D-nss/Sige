@extends('layouts.app')

@section('title', 'Cadastro de uma Ação de Extensão')

@section('content')

<div class="container-fluid">
    <h1>Cadastrar nova Ação de Extensão</h1>
  <div class="row">
    <form action="{{route('acao-extensao.store')}}" id="form_acao_extensao" method="POST">
        @csrf
        @include('acoes-extensao._form')
        <a href="/acoes-extensao" class="btn btn-secondary btn-user btn-block ">
            <span class="icon text-white-50">
              <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Voltar</span>
          </a>
    </form>

  </div>
</div>

@endsection
