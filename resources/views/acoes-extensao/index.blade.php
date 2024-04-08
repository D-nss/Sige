@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item text-primary">Ações de Extensão</li>
    <li class="breadcrumb-item active">Minhas Ações</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        Olá, {{ $user->name }}
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <p>
                        Você ainda não criou nenhuma Ação de Extensão. Você pode começar selecionando o botão abaixo, ou acessando <span class="fw-700">Ações de Extensão / Cadastrar</span>
                        </p>
                        <div class="form-group">
                            <a href="{{ url('acoes-extensao/novo') }}" class="btn btn-primary btn-pills ">
                                <i class="far fa-plus-circle"></i>
                                Nova Ação
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection