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
            Bem vindo(a) a sua área de coordenação das Ações de Extensão da EXTECULT
        </small>
    </h1>
</div>
@if(count($pendentes) > 0 && $userNaComissao)
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-3">
            <span class="h5">Existem Ações de Extensão Pendentes para Aprovação</span>
        </div>
    </div>
</div>
@endif
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <h1 class="subheader-title">
        <span>Visão geral</span>
    </h1>
</div>
@if($userNaComissao || $userNaComissaoConext)
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
@endif
<div class="row">
    <div class="col-lg-12 col-xl-12">
                                <!--Table head-->
                                <div id="panel" class="panel">
                                    <div class="panel-hdr ">
                                        <h2>
                                            Minhas Ações de Extensões
                                        </h2>
                                        <div class="panel-toolbar">
                                            <a href="/acoes-extensao/novo" class="btn btn-success btn-block btn-pills waves-effect waves-themed"><i class="fal fa-plus-circle"></i> Nova Ação</a>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="frame-wrap">
                                                <table class="table m-0">
                                                    <thead class="thead-themed">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Título / Linha</th>
                                                            <th>Modalidade / Área Temática</th>
                                                            <th>Situação</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($acoes_extensao_usuario) < 1)
                                                        <tr>
                                                            Não há Ações de Extensão suas cadastradas
                                                        </tr>
                                                        @else
                                                        @foreach($acoes_extensao_usuario as $acao_extensao)
                                                        <tr>
                                                            <th scope="row">{{$acao_extensao->id}}</th>
                                                            <td>
                                                                <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 ">
                                                                    {{$acao_extensao->titulo}}
                                                                </a>
                                                                @if($acao_extensao->status == 'Pendente')

                                                                <span class="fw-300 color-danger-500"><i class="fal fa-exclamation-circle"></i><i> Ação pendente!</i></span>

                                                                @endif
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
                                                                @if($user->id == $acao_extensao->user_id)
                                                                    <a href="{{ url('acoes-extensao/' . $acao_extensao->id ) }}" class="btn btn-xs btn-info">Ver Detalhes</a>
                                                                    <a href="{{ url('acoes-extensao/'. $acao_extensao->id .'/editar') }}" class="btn btn-primary btn-xs">Editar</a>
                                                                    @if($acao_extensao->status_avaliacao_conext === 'Aprovado')
                                                                        <a href="{{ url('acoes-extensao/'. $acao_extensao->id .'/ocorrencias') }}" class="btn btn-xs btn-warning">Ocorrências</a>
                                                                    @endif
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="modal{{ $acao_extensao->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $acao_extensao->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <form action="{{route('acao_extensao.destroy', ['acao_extensao' => $acao_extensao->id])}}" method="post">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalLabel{{ $acao_extensao->id }}">Alerta</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <p>Deseja realmente remover a ação?</p>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                                    <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                                                                </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                    @if($acao_extensao->status == 'Rascunho')
                                                                        <button type="button" class="btn btn-xs btn-danger waves-effect waves-themed" data-toggle="modal" data-target="#modal{{ $acao_extensao->id }}">Excluir
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    </div>
</div>
@if(count($pendentes_unidade) > 0 && ($userNaComissao))
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <h1 class="subheader-title text-danger">
        <span>Pendende de sua aprovação (Unidade)</span>
    </h1>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-warning-50">
                <h2>
                    Ações de Extensão Pendentes que necessitam de sua aprovação
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
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@if(count($pendentes) > 0 && $userNaComissaoConext))
<div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
    <h1 class="subheader-title text-danger">
        <span>Pendende de sua aprovação (Conext)</span>
    </h1>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <!--Table head-->
        <div id="panel" class="panel">
            <div class="panel-hdr bg-warning-50">
                <h2>
                    Ações de Extensão Pendentes que necessitam de sua aprovação
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
                                    <th>Ação de Extensão</th>
                                    <th>Modalidade / Área Temática</th>
                                    <th>Coordenador</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendentes as $acao_extensao)
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
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endif

@endsection
