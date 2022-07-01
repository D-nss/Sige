@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos Editais</li>
    <li class="breadcrumb-item">Edital</li>
    <li class="breadcrumb-item active">Editar Edital</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Edital</span>
        <small>
        Alterar edital {{ $edital->titulo }}
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
          
        </div>
    </div>
</div>

<div class="container-fluid">

  <div class="row">
    <div class="col-xl-12">
      
      @include('edital._form')

    </div>
  </div>
</div>

@endsection