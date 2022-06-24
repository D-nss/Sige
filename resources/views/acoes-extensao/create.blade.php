@extends('layouts.app')

@section('title', 'Cadastro de uma Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Nova Ação</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-plus'></i> Nova Ação de Extensão
        <small>
            Cadastro de uma nova Ação de Extensão
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Formulário <span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="panel-tag">
                        Espaço para informar os erros na validação do formulário.
                    </div>
                    <form action="{{route('acao_extensao.store')}}" id="form_acao_extensao" method="POST">
                        @csrf
                        @include('acoes-extensao._form')
                        <a href="/acoes-extensao" class="btn btn-secondary btn-user btn-block ">
                            <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
