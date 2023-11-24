@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos Editais</li>
    <li class="breadcrumb-item">Questões</li>
    <li class="breadcrumb-item active">Adicionar Questões</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Questões</span>
        <small>
        Cadastrar as questões para o edital <span class="text-secondary">{{$edital->titulo}}</span>
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
  
      <div class="card mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar as questões para o Edital <span class="text-success">{{ $edital->titulo }}</span></h6>
          </div>
          <div class="card-body">
              <div class="mt-3">
                  @include('questoes._form')

                  @include('questoes._lista_complementar')

                  <div class="mt-3">
                        <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary btn-pills waves-effect waves-themed float-right">
                            <i class="far fa-paper-plane"></i>  
                            Finalizar
                        </a>
                        <a href="#" onclick="history.back()" class="btn btn-outline-primary btn-pills waves-effect waves-themed float-left">
                            <span class="icon">
                                <i class="fal fa-long-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                        </a>
                  </div>
                  
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
  <!-- /.container-fluid -->

@endsection