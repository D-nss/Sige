@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
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
                    <div class="accordion accordion-outline" id="js_demo_accordion-3">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#js_demo_accordion-3b" aria-expanded="false">
                                    <i class="fal fa-filter width-2 fs-xl"></i>
                                    Pesquisa Avançada
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal">
                                            <i class="fal fa-minus fs-xl"></i>
                                        </span>
                                        <span class="collapsed-hidden">
                                            <i class="fal fa-plus fs-xl"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="js_demo_accordion-3b" class="collapse" data-parent="#js_demo_accordion-3">
                                <div class="card-body">
                                    <form action="{{route('acao_extensao.filtrar')}}" id="form_filtro_acao_extensao" class="form-horizontal form-label-left" method="POST">
                                        @csrf
                                        @include('acoes-extensao._filtro')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        Linha: <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <a href="/acoes-extensao/tipos/{{$acao_extensao->tipo}}" class="text-success">
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
                                    <a href="/acoes-extensao/areas/{{$area_tematica->id}}" class="text-muted small text-truncate">
                                    <br>{{$area_tematica->nome}}
                                    </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{$acao_extensao->nome_coordenador}}
                                    <div class="text-muted small text-truncate">
                                        Unidade: <a href="/acoes-extensao/unidades/{{$acao_extensao->unidade->id}}" >{{$acao_extensao->unidade->sigla}}</a>
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <a href="/acoes-extensao/situacao/{{$acao_extensao->situacao}}">
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
                                    </a>
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
