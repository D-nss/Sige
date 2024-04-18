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
        Olá, {{$user->name}}
        <small>
            Bem vindo(a) a sua área de pendências das Ações de Extensão da EXTECULT
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <p>
                    Abaixo segue as Ações de Extensão que requerem sua atenção, caso deseje ver as suas Ações de Extensão acesse <span class="fw-700">Ações de Extensão / Minhas Ações</span> no menu lateral.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($pendentes_unidade) > 0)
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-primary">
                <h2 class="text-light">
                    Ações de Extensão Pendentes de análise pela <span class="fw-700">Comissaõ de Extensão da Unidade</span>
                </h2>
                <div class="panel-toolbar">
                    <h5 class="m-0">
                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                            {{count($pendentes_unidade)}}
                        </span>
                    </h5>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <div class="row">
                            <div class="col-12">
                                <h5>
                                    Clique no título da ação para analisar a Ação de Extenção
                                </h5>
                            </div>
                        </div>
                        <table class="table m-0">
                            <thead class="thead-themed">
                                <tr>
                                    <th>#</th>
                                    <th>Ação de Extensão</th>
                                    <th>Modalidade / Área Temática</th>
                                    <th>Coordenador</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendentes_unidade as $acao_extensao)
                                <tr>
                                    <th scope="row">{{$acao_extensao->id}}</th>
                                    <td>
                                        <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 ">
                                            {{$acao_extensao->titulo}}
                                        </a>
                                        <div class="d-block text-muted fs-sm">
                                            Linha: <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/acoes-extensao/modalidades/{{$acao_extensao->modalidade}}" class="text-success">
                                            @switch($acao_extensao->modalidade)
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
                                        <a href="/acoes-extensao/situacao/{{$acao_extensao->status}}">
                                            @switch($acao_extensao->status)
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
                                        </a>

                                        <div class="text-muted small text-truncate">
                                            Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pendentes_unidade->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@if(count($pendentes_graduacao) > 0 )
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
   
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-primary">
                <h2 class="text-light">
                    Ações de Extensão Pendentes de análise pela <span class="fw-700">Comissão de Graduação</span>
                </h2>
                <div class="panel-toolbar">
                    <h5 class="m-0">
                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                            {{count($pendentes_graduacao)}}
                        </span>
                    </h5>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <div class="row">
                            <div class="col-12">
                                <h5>
                                    Clique no botão <span class="fw-700">Analisar parâmetros pedagógicos</span> para fazer sua análise da Ação de Extensão
                                </h5>
                            </div>
                        </div>
                        <table class="table m-0">
                            <thead class="thead-themed">
                                <tr>
                                    <th>#</th>
                                    <th>Ação de Extensão</th>
                                    <th>Modalidade / Área Temática</th>
                                    <th>Coordenador</th>
                                    <th>Situação</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendentes_graduacao as $acao_extensao)
                                <tr>
                                    <th scope="row">{{$acao_extensao->id}}</th>
                                    <td>
                                        <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 ">
                                            {{$acao_extensao->titulo}}
                                        </a>
                                        <div class="d-block text-muted fs-sm">
                                            Linha: <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/acoes-extensao/modalidades/{{$acao_extensao->modalidade}}" class="text-success">
                                            @switch($acao_extensao->modalidade)
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
                                        <a href="/acoes-extensao/situacao/{{$acao_extensao->status}}">
                                            @switch($acao_extensao->status)
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
                                        </a>

                                        <div class="text-muted small text-truncate">
                                            Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-pills waves-effect waves-themed fs-xl" data-toggle="modal" data-target="#modalAcao{{$acao_extensao->id}}">
                                            <div
                                                data-toggle="tooltip"
                                                data-placement="bottom"
                                                title=""
                                                data-original-title="Analisar parâmetros pedagógicos"
                                            >
                                                <!-- <i class="fal fa-list"></i> -->
                                                Analisar parâmetros pedagógicos
                                            </div>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalAcao{{$acao_extensao->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            Análise de Parâmetros Pedagógicos
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('acoes_extensao.comissao_graduacao.store', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Atende aos requisitos?</label>
                                                            <select name="status_comissao_graduacao" class="form-control">
                                                                <option value=""> ... </option>
                                                                <option value="Sim">Sim</option>
                                                                <option value="Não">Não</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Parecer da Comissão</label>
                                                            <textarea name="parecer_comissao_graduacao" class="form-control" cols="30" rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pendentes_graduacao->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@if(count($pendentes_comite_consultivo) > 0)
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <h1 class="subheader-title text-danger">
        <span>Pendentes (Comitê Consultivo)</span>
    </h1>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-warning-50">
                <h2>
                    Ações de Extensão Pendentes que necessitam de sua análise
                </h2>
                <div class="panel-toolbar">
                    <h5 class="m-0">
                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                            {{count($pendentes_comite_consultivo)}}
                        </span>
                    </h5>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap">
                        <div class="row">
                            <div class="col-12">
                                <h5>
                                    Clique no título da ação para analisar a Ação de Extenção
                                </h5>
                            </div>
                        </div>
                        <table class="table m-0">
                            <thead class="thead-themed">
                                <tr>
                                    <th>#</th>
                                    <th>Ação de Extensão</th>
                                    <th>Modalidade / Área Temática</th>
                                    <th>Coordenador</th>
                                    <th>Situação</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendentes_comite_consultivo as $acao_extensao)
                                <tr>
                                    <th scope="row">{{$acao_extensao->id}}</th>
                                    <td>
                                        <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 ">
                                            {{$acao_extensao->titulo}}
                                        </a>
                                        <div class="d-block text-muted fs-sm">
                                            Linha: <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/acoes-extensao/modalidades/{{$acao_extensao->modalidade}}" class="text-success">
                                            @switch($acao_extensao->modalidade)
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
                                        <a href="/acoes-extensao/situacao/{{$acao_extensao->status}}">
                                            @switch($acao_extensao->status)
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
                                        </a>

                                        <div class="text-muted small text-truncate">
                                            Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pendentes_comite_consultivo->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@endsection
