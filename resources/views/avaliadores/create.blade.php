@extends('layouts.app')

@section('title', 'Cadastrar novos Conselheiros')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Avaliadores</span>
            <small>
            Cadastrar os avaliadores para o edital <span class="text-secondary">{{$edital->titulo}}</span>
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">

      <div class="col-lg-12">

        @include('avaliadores._form')

      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

@endsection





