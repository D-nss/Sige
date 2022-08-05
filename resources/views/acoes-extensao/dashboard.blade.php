@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Dashboard</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-chart-area'></i> Banco de Ações de Extensão <span class='fw-300'>Dashboard</span>
        <small>
            Painel de informações das Ações de Extensão da Unidade
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center mr-3">
            <span class="fw-300 fs-xs d-block opacity-50">
                <small>TOTAIS UNICAMP</small>
            </span>
            <span class="fw-500 fs-xl d-block color-primary-500">
                2200
            </span>
        </div>
    </div>
    <div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
        <div class="d-inline-flex flex-column justify-content-center mr-3">
            <span class="fw-300 fs-xs d-block opacity-50">
                <small>TOTAIS UNIDADE</small>
            </span>
            <span class="fw-500 fs-xl d-block color-danger-500">
                500
            </span>
        </div>
    </div>
</div>
<div class="demo demo-v-spacing-lg">
    <div class="btn-group btn-group-lg">
        <button type="button" class="btn btn-primary"><span class="fal fa-plus mr-1"></span>Cadastrar</button>
        <button type="button" class="btn btn-primary"><span class="fal fa-list mr-1"></span>Listar Ações</button>
        <button type="button" class="btn btn-primary"><span class="fal fa-map-marker-check mr-1"></span>Mapa Extensão</button>
        <button type="button" class="btn btn-primary"><span class="fal fa-file-alt mr-1"></span>Gerais Unicamp</button>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    500
                    <small class="m-0 l-h-n">Ações Cadastradas</small>
                </h3>
            </div>
            <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    400
                    <small class="m-0 l-h-n">Concluídos</small>
                </h3>
            </div>
            <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    80
                    <small class="m-0 l-h-n">Em Andamento</small>
                </h3>
            </div>
            <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    20
                    <small class="m-0 l-h-n">Desativados</small>
                </h3>
            </div>
            <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-xl-3">
        <div id="panel-6" class="panel">
            <div class="panel-hdr">
                <h2>Ações Área Temática</h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div id="flotPie" class="w-100" style="height:250px"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
