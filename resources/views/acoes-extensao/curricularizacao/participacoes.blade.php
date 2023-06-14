@extends('layouts.app')

@section('title', 'Participações em Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item active">Ações de Extensão</li>
    <li class="breadcrumb-item">Participações</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Participações em Ações de Extensão
        <small>
            Listagem das participações em Ações de Extensão na qual você se candidatou
        </small>
    </h1>
</div>

<div class="container-fluid">
  <!-- <div class="row">
    <div class="col-xl-12"> -->
        <div class="row">
            @foreach($curricularizacoes as $curricularizacao)
            <div class="col-md-2  bg-light m-2 p-3 d-flex flex-column shadow">
                <label class="text-muted disabled fs-xs fw-500">Ação de Extensão titulo</label>
                <h3 class="text-primary fw-700">{{ $curricularizacao->titulo }}</h3>

                <label class="text-muted disabled fs-xs fw-500">Ocorrência</label>

                <label class="text-muted disabled fs-xs fw-500 mb-0">Local</label>
                <span class="text-success fw-500 fs-lg mb-2">{{ $curricularizacao->local }}</span>
                
                <label class="text-muted disabled fs-xs fw-500 mb-0">Inicio</label>
                <span class="text-black fw-500 fs-lg mb-2">{{ date('d/m/Y H:i', strtotime($curricularizacao->data_hora_inicio)) }}</span>

                <label class="text-muted disabled fs-xs fw-500 mb-0">Fim</label>
                <span class="text-black fw-500 fs-lg mb-1">{{ date('d/m/Y H:i', strtotime($curricularizacao->data_hora_fim)) }}</span>

                <div class="flex-1 mb-1">
                    <label class="text-muted disabled fs-xs fw-500 mb-0">Status</label>
                    <br>
                    <span class="
                                badge 
                                @switch($curricularizacao->status)
                                    @case('Aceito')
                                        badge-success
                                        @break
                                    @case('Não Aceito')
                                        badge-danger
                                        @break
                                    @default
                                        badge-warning
                                        @break
                                @endswitch
                                badge-success 
                                badge-pill px-3 py-2 fs-md"
                    >
                        {{ $curricularizacao->status ? $curricularizacao->status : 'Em Análise' }}
                    </span>
                </div>

                <label class="text-muted disabled fs-xs fw-500 mb-0">Horas realizadas</label>
                <span class="text-black fw-500 fs-lg mb-1">{{ $curricularizacao->horas ? $curricularizacao->horas : 0 }}</span>

                <!-- <div class="flex-1 mb-1">
                    <label class="text-muted disabled fs-xs fw-500 mb-0">Certificado</label>
                    <br>
                    <button class="btn btn-danger btn-sm">Gerar PDF</button>
                </div> -->
            </div>
            @endforeach
        </div>
    <!-- </div>
</div> -->
</div>
@endsection