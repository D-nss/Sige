@extends('layouts.app')

@section('title', 'Cadastrar novo Cronograma')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processo Editais</li>
    <li class="breadcrumb-item">Cronograma</li>
    <li class="breadcrumb-item active">Novo Cronograma</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Cronograma</span>
        <small>
        Cadastro do cronograma para o edital <span class="text-secondary">{{$edital->titulo}}</span>
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">

      <div class="col-lg-12">

        @include('cronograma._form')

      </div>
    </div>
  </div>
        <!-- /.container-fluid -->

@endsection





