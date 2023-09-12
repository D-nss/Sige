@extends('layouts.app')

@section('title', 'Ocorrências - Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Ocorrências e Curricularização</li>
    <li class="breadcrumb-item">Catálogo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Ações de Extensão com Inscrições Abertas
        <small>
            Listagem das Ocorrências de Ações de Extensão Abertas para Participação
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Para ver detalhes, clique sobre o registro na tabela abaixo
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <!-- datatable start -->
                    <table id="dt-acoes-extensao" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                 <th class="text-uppercase text-muted py-2 px-3">Titulo/ Linha/ Área</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Local</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Inicio (Inscrições)</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Fim (Inscrições)</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ocorrencias as $ocorrencia)
                            <tr>
                                <td>
                                    <a href="/acoes-extensao/{{$ocorrencia->acao_extensao->id}}" class="fs-lg fw-500 d-block">
                                        {{ $ocorrencia->acao_extensao->titulo }}
                                    </a>
                                    <div class="d-block text-muted fs-sm">
                                        <span class="fs-xs fw-400 text-dark">{{ $ocorrencia->acao_extensao->linha_extensao->nome }}</span>
                                    </div>
                                    @foreach ($ocorrencia->acao_extensao->areas_tematicas as $area_tematica)
                                        <span class="text-muted small text-truncate">
                                            {{$area_tematica->nome}}
                                        </span>
                                    @endforeach
                                </td>
                                <td><span class="text-success">{{$ocorrencia->local}}</span></td>
                                <td>{{isset($ocorrencia->inicio_inscricoes) ? $ocorrencia->inicio_inscricoes->format('d/m/Y') : 'Sem curricularização'}}</td>
                                <td>{{isset($ocorrencia->fim_inscricoes) ? $ocorrencia->fim_inscricoes->format('d/m/Y') : 'Sem curricularização'}}</td>
                                <td>
                                    <a href="{{ url('acoes-extensao/ocorrencias/'. $ocorrencia->id ) }}" class="btn btn-xs btn-info">Ver Detalhes</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- datatable end -->
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
