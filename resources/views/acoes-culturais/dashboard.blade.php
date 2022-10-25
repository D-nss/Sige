@extends('layouts.app')

@section('title', 'Dashboard das Ações Culturais')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item active">Dashboard</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-chart-area'></i> Banco de Ações Culturais <span class='fw-300'>Dashboard</span>
        <small>
            Painel de informações das Ações Culturais da Unidade <span class='color-danger-500'></span>
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center mr-3">
            <span class="fw-300 fs-xs d-block opacity-50">
                <small>TOTAIS UNICAMP</small>
            </span>
            <span class="fw-500 fs-xl d-block color-primary-500">

            </span>
        </div>
    </div>
    <div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
        <div class="d-inline-flex flex-column justify-content-center mr-3">
            <span class="fw-300 fs-xs d-block opacity-50">
                <small>TOTAIS UNIDADE</small>
            </span>
            <span class="fw-500 fs-xl d-block color-danger-500">

            </span>
        </div>
    </div>
</div>

<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-3">
            <span class="h5">Existem Ações Culturais pendentes de aprovação pela Unidade</span>
        </div>
    </div>
</div>

<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <div class="btn-group btn-group-lg">
        <a href="/acoes-culturais/novo" class="btn btn-primary"><span class="fal fa-plus mr-1"></span>Cadastrar</a>
        <a href="/acoes-culturais" class="btn btn-primary"><span class="fal fa-list mr-1"></span>Listar Ações</a>
        <a href="/acoes-culturais/mapa/cultura" class="btn btn-primary"><span class="fal fa-map-marker-check mr-1"></span>Mapa Extensão</a>
        <a href="/acoes-culturais/novo" class="btn btn-primary"><span class="fal fa-file-alt mr-1"></span>Gerais Unicamp</a>
    </div>
</div>
@endsection
