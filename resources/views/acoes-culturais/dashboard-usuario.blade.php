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
                {{$total}}
            </span>
        </div>
    </div>
    
</div>

<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <div class="btn-group btn-group-lg">
        <a href="/acoes-culturais/novo" class="btn btn-primary"><span class="fal fa-plus mr-1"></span>Cadastrar</a>
        <a href="/acoes-culturais" class="btn btn-primary"><span class="fal fa-list mr-1"></span>Listar Ações</a>
        <a href="/acoes-culturais/mapa/cultura" class="btn btn-primary"><span class="fal fa-map-marker-check mr-1"></span>Mapa Extensão</a>
        <!-- <a href="/acoes-culturais/novo" class="btn btn-primary"><span class="fal fa-file-alt mr-1"></span>Gerais Unicamp</a> -->
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-fusion-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {{$total_cadastrados}}
                    <small class="m-0 l-h-n">Ações Cadastradas</small>
                </h3>
            </div>
            <i class="fal fa-leaf position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {{$total_aprovados}}
                    <small class="m-0 l-h-n">Aprovados</small>
                </h3>
            </div>
            <i class="fal fa-check-double position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {{$total_pendentes}}
                    <small class="m-0 l-h-n">Pendentes</small>
                </h3>
            </div>
            <i class="fal fa-clock position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="p-3 bg-danger-200 rounded overflow-hidden position-relative text-white mb-g">
            <div class="">
                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                    {{$total_desativados}}
                    <small class="m-0 l-h-n">Desativados</small>
                </h3>
            </div>
            <i class="fal fa-ban position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-primary-600">
                <h2>
                    Minhas Ações de Extensão Cadastradas <span class="fw-300 color-fusion-500"></span>
                </h2>
                <div class="panel-toolbar">
                    <h5 class="m-0">
                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                            {{count($acoes_cultural_usuario)}}
                        </span>
                    </h5>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <table class="table m-0">
                            <thead class="thead-themed">
                                <tr>
                                    <th>#</th>
                                    <th>Ação de Cultura</th>
                                    <th>Modalidade</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($acoes_cultural_usuario as $acao_cultural)
                                <tr>
                                    <th scope="row">{{$acao_cultural->id}}</th>
                                    <td>
                                        <a href="/acoes-culturais/{{$acao_cultural->id}}" class="fs-lg fw-500 ">
                                            {{$acao_cultural->titulo}}
                                        </a>
                                        <div class="d-block text-muted fs-sm">
                                            Segmento: {{$acao_cultural->segmento_cultural}}
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ucfirst($acao_cultural->tipo_evento) }}
                                    </td>
                                    <td>
                                        {{$acao_cultural->nome_coordenador}}
                                        <div class="text-muted small text-truncate">
                                            Unidade: {{$acao_cultural->unidade->sigla}}
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($acao_cultural->status)
                                                @case('Desativado')
                                                <span class="badge badge-danger">Desativado</span>
                                                    @break
                                                @case('Pendente')
                                                    <span class="badge badge-warning">Pendente</span>
                                                    @break
                                                @case('Rascunho')
                                                    <span class="badge badge-secondary">Rascunho</span>
                                                    @break
                                                @case('Aprovado')
                                                    <span class="badge badge-success">Aprovado</span>
                                                    @break
                                                @default
                                                <span class="badge badge-warning">Indefinido</span>
                                        @endswitch
                                        <div class="text-muted small text-truncate">
                                            Atualizado: {{$acao_cultural->updated_at->format('d/m/Y')}}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Não há Ações de Extensão suas cadastradas
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-warning-600">
                <h2>
                    Ações de Extensão Pendentes que necessitam de aprovação
                </h2>
                <div class="panel-toolbar">
                    <h5 class="m-0">
                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                            {{count($pendentes)}}
                        </span>
                    </h5>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <table class="table m-0">
                            <thead class="thead-themed">
                                <tr>
                                    <th>#</th>
                                    <th>Ação de Cultura</th>
                                    <th>Modalidade</th>
                                    <th>Coordenador</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendentes as $acao_cultural)
                                <tr>
                                    <th scope="row">{{$acao_cultural->id}}</th>
                                    <td>
                                        <a href="/acoes-culturais/{{$acao_cultural->id}}" class="fs-lg fw-500 ">
                                            {{$acao_cultural->titulo}}
                                        </a>
                                        <div class="d-block text-muted fs-sm">
                                            Segmento: {{$acao_cultural->segmento_cultural}}
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        {{ ucfirst($acao_cultural->tipo_evento) }}
                                    </td>
                                    <td>
                                        {{$acao_cultural->nome_coordenador}}
                                        <div class="text-muted small text-truncate">
                                            Unidade: {{$acao_cultural->unidade->sigla}}
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($acao_cultural->status)
                                                @case('Desativado')
                                                <span class="badge badge-danger">Desativado</span>
                                                    @break
                                                @case('Pendente')
                                                    <span class="badge badge-warning">Pendente</span>
                                                    @break
                                                @case('Rascunho')
                                                    <span class="badge badge-secondary">Rascunho</span>
                                                    @break
                                                @case('Aprovado')
                                                    <span class="badge badge-success">Aprovado</span>
                                                    @break
                                                @default
                                                <span class="badge badge-warning">Indefinido</span>
                                        @endswitch
                                        <div class="text-muted small text-truncate">
                                            Atualizado: {{$acao_cultural->updated_at->format('d/m/Y')}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
