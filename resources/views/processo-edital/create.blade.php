@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<div class="container-fluid">

    @include('layouts._includes._status')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Processos de Editais</span>
            <small>
                Criar novo processo de edital
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
              
            </div>
        </div>
    </div>
    <div class="row">

      <div class="col-lg-12">
        <!-- Default Card Example -->
        @include('processo-edital._panel')

      </div>
    </div>
  </div>
        <!-- /.container-fluid -->

@endsection