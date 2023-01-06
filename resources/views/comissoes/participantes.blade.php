@extends('layouts.app')

@section('title', 'Comissões')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos Editais</li>
    <li class="breadcrumb-item">Comissões</li>
    <li class="breadcrumb-item active">Adicionar Participantes Comissões</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Comissões</span>
        <small>
        Adicionar Participantes a Comissão <strong>{{ $comissao->nome }}</strong> <strong>{{ $comissao->edital == null ? ' da Unidade ' . $comissao->unidade->sigla : 'do Edital ' . $comissao->edital->titulo }}</strong>
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
            
        </div>
    </div>
</div>
<div class="container-fluid">

    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
            <span class="fw-300"><i>Preencha o formulário para adicionar participantes a comissão</i></span>
            </h2>
            <!-- <div class="panel-toolbar">
                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
            </div> -->
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <div class="my-2">
                    @include('comissoes._form_participantes')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

