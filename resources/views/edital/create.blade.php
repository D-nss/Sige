@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<div class="container-fluid">

  <div class="subheader">
      <h1 class="subheader-title">
          <span class="text-success">Processo de Editais</span>
          <small>
          Cadastro de edital
          </small>
      </h1>
      <div class="subheader-block d-lg-flex align-items-center">
          <div class="d-inline-flex flex-column justify-content-center">
            
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-xl-12">      
      <!-- Default Card Example -->
      @include('edital._form')

    </div>
  </div>
</div>
        <!-- /.container-fluid -->

@endsection