@extends('layouts.app')

@section('title', 'Cadastro de uma Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao">BAEC</a></li>
    <li class="breadcrumb-item active">Nova Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> Nova Ação de Extensão
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
                    <form action="{{route('acao_extensao.store')}}" id="form_acao_extensao" method="POST">
                        @csrf
                        @include('acoes-extensao._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
