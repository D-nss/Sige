@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Listagem</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-plus'></i> Ações de Extensão
        <small>
            Listagem das Ações de Extensão cadastradas
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Para ver detalhes e atualizar os dados, clique sobre o registro na tabela abaixo
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    Em desenvolvimento...
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
