@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<div class="container-fluid">

  @include('layouts._includes._status')

  @include('layouts._includes._validacao')

  <div class="subheader">
      <h1 class="subheader-title">
          <span class="text-success">Processo de Editais</span>
          <small>
          Alterar edital {{ $edital->titulo }}
          </small>
      </h1>
      <div class="subheader-block d-lg-flex align-items-center">
          <div class="d-inline-flex flex-column justify-content-center">
            
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      
      @include('edital._form')

    </div>
  </div>
</div>

@endsection