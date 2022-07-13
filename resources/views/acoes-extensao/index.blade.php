@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Listagem</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao/novo"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Cadastrar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Ações de Extensão
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
                    <!-- datatable start -->
                    <table id="dt-acoes-extensao" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                 <th class="text-uppercase text-muted py-2 px-3">#</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Ação de Extensão</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Tipo / Área Temática</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Coordenador</th>
                                <th class="text-uppercase text-muted py-2 px-3">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acoes_extensao as $acao_extensao)
                            <tr >
                                <td>{{$acao_extensao->id}}</td>
                                <td>
                                    <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 d-block">
                                        {{$acao_extensao->titulo}}
                                    </a>
                                    <div class="d-block text-muted fs-sm">
                                        Linha: {{$acao_extensao->linha_extensao->nome}}
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="text-success">
                                        @switch($acao_extensao->tipo)
                                            @case(1)
                                                Programa
                                                @break
                                            @case(2)
                                                Projeto
                                                @break
                                            @case(3)
                                                Curso
                                                @break
                                            @case(4)
                                                Evento
                                                @break
                                            @case(5)
                                                Prestação de serviços
                                                @break
                                            @default
                                                Indefinido
                                        @endswitch
                                    </a>
                                    @foreach ($acao_extensao->areas_tematicas as $area_tematica)
                                    <a href="" class="text-muted small text-truncate">
                                    <br>{{$area_tematica->nome}}
                                    </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{$acao_extensao->nome_coordenador}}
                                    <div class="text-muted small text-truncate">
                                        Unidade: <a href="" >{{$acao_extensao->unidade->sigla}}</a>
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    @switch($acao_extensao->situacao)
                                        @case(1)
                                        <span class="badge badge-danger">Desativado</span>
                                            @break
                                        @case(2)
                                            <span class="badge badge-info">Em Andamento</span>
                                            @break
                                        @case(3)
                                            <span class="badge badge-success">Concluído</span>
                                            @break
                                        @default
                                        <span class="badge badge-warning">Indefinido</span>
                                    @endswitch
                                    <div class="text-muted small text-truncate">
                                        Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                    </div>
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
