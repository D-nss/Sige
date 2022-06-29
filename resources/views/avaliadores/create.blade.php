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
        <div class="card mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para cadastar os conselheiros</h6>
          </div>
          <div class="card-body">

            @include('avaliadores._form')

            <div class="border border-success rounded-lg  mt-3 p-3">

              <h3 class="font-weight-bold">Avaliadores</h3>

              @include('avaliadores._table')

            </div>

            <div class="mt-3">
              <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary btn-user float-right">
                  <span class="text">Finalizar</span>
              </a>
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
  <!-- /.container-fluid -->

@endsection





