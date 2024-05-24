@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item text-primary">Ações de Extensão</li>
    <li class="breadcrumb-item active">Catálogo Unidade</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        Olá, {{ $user->name }}
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <p>
                        Abaixo estão listadas as Ações de Extensão da sua unidade, caso deseje cadastrar uma nova Ação de Extensão clique no botão abaixo, ou acesse <span class="fw-700">Ações de Extensão / Cadastrar</span>
                        </p>
                        <div class="form-group">
                            <a href="{{ url('acoes-extensao/novo') }}" class="btn btn-primary btn-pills ">
                                <i class="far fa-plus-circle"></i>
                                Nova Ação
                            </a>
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
                <div class="panel-hdr ">
                    <h2>
                        Ações de Extensão da Unidade {{ $user->unidade->sigla }}
                        
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span class="text-muted">Para ver detalhes, clique sobre o registro na tabela abaixo</span>
                                </div>
                            </div>
                            <table class="table m-0">
                                <thead class="thead-themed">
                                    <tr>
                                        <th>#</th>
                                        <th>Título / Linha</th>
                                        <th>Modalidade / Área Temática</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($acoes_extensao_unidade) < 1)
                                    <tr>
                                        Não há Ações de Extensão suas cadastradas
                                    </tr>
                                    @else
                                    @foreach($acoes_extensao_unidade as $acao_extensao)
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
                                            @if($acao_extensao->status_avaliacao_conext == 'Reconhecido' || $acao_extensao->ciencia_status == 'Reconhecido')
                                                <span class="badge badge-primary">Reconhecido ProEC</span>
                                            @elseif($acao_extensao->status == 'Aprovado')
                                                <span class="badge badge-primary">Aprovado Unidade</span>
                                            @elseif($acao_extensao->status == 'Rascunho')
                                                <span class="badge badge-secondary">Rascunho</span>
                                            @endif

                                            <div class="text-muted small text-truncate">
                                                Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $acoes_extensao_unidade->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection