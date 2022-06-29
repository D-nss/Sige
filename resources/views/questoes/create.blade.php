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
  
      <div class="card mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar as questões para o Edital <span class="text-success">{{ $edital->titulo }}</span></h6>
          </div>
          <div class="card-body">
              <div class="mt-3">
                  @include('questoes._form')

                  @include('questoes._table_complementares')

                  @include('questoes._table_avaliativa')

                  <div class="mt-3">
                      <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary float-right">Finalizar</a>
                      <a href="#" onclick="history.back()" class="btn btn-secondary btn-user float-left">
                          <span class="icon text-white-50">
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