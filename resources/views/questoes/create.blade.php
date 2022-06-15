@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Questões</span>
            <small>
            Cadastrar as questões para o edital <span class="text-secondary">{{$edital->titulo}}</span>
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">

      <div class="col-lg-12">

        @include('questoes._form')

      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

@endsection