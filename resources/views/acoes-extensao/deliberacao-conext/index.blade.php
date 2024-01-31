@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Exensão</li>
    <li class="breadcrumb-item active">Listagem Deliberação</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">
            @if($acoes_extensao->count() > 0)
                As ações listadas abaixo já foram enviadas para deliberação, e estão aguardando reconhecimento do Conext.<br>
                Para marcar a deliberação selecione as ações desejadas e clique no botão "Marcar Reconhecimento"

            @else
                Para marcar a deliberação primeiro deve ser gerado a planilha clicando no botão "Gerar Deliberação".<br>
                Após passar pelo conext esta página deve ser atualizada.
            @endif
            </span>
        </div>   
    </div>
</div>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> 
        Ações de Extensão Reconhecidas pelo Comitê Consultivo
        <small>
            Listagem das Ações de Extensão a serem deliberadas pelo conext
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
                    <div class="panel-toolbar">
                        <!-- <a href="/acoes-extensao/novo" class="btn btn-success btn-block btn-pills waves-effect waves-themed"><i class="fal fa-plus-circle"></i> Nova Ação</a> -->
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{ route('acao_extensao_pendencias.deliberacao_conext.reconhecer') }}" method="post">
                        @csrf
                        <!-- datatable start -->
                        <table id="dt-acoes-extensao" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-uppercase text-muted py-2 px-3">#</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Ação de Extensão</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Modalidade / Linha / Área</th>
                                    <th class="text-uppercase text-muted py-2 px-3">ODS</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Coordenador</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Atualização</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acoes_extensao as $acao_extensao)
                                <tr>
                                    <td>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="selecionados[]" value="{{$acao_extensao->id}}" >
                                        </div>
                                    </td>
                                    <td>{{$acao_extensao->id}}</td>
                                    <td>
                                        <div class="d-block">
                                            <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500">
                                                {{$acao_extensao->titulo}}
                                            </a>
                                        </div>
                                        <div class="d-block text-muted fs-sm">
                                            <small class="mt-0 mb-3 text-muted">
                                                @foreach (explode(',', $acao_extensao->palavras_chaves) as $palavra_chave)
                                                <a href="/acoes-extensao/palavra-chave/{{$palavra_chave}}"><span class="badge badge-secondary">{{$palavra_chave}}</span></a>
                                                @endforeach
                                            </small>
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
                                        <div class="d-block text-muted fs-sm">
                                            <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                        </div>
                                        @foreach ($acao_extensao->areas_tematicas as $area_tematica)
                                        <a href="/acoes-extensao/areas/{{$area_tematica->id}}" class="text-muted small text-truncate">
                                            {{$area_tematica->nome}}
                                        </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($acao_extensao->objetivos_desenvolvimento_sustentavel as $ods)
                                        <a href="/acoes-extensao/ods/{{$ods->id}}" class="d-block text-dark fs-sm">
                                            {{$ods->nome}}
                                        </a>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$acao_extensao->nome_coordenador}}
                                        <div class="text-muted small text-truncate">
                                            Unidade: <a href="/acoes-extensao/unidades/{{$acao_extensao->unidade->id}}">{{$acao_extensao->unidade->sigla}}</a>
                                            <br>
                                        </div>
                                    </td>
                                    <td>
                                        {{$acao_extensao->updated_at->format('d/m/Y')}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm float-right" >Marcar Reconhecimento</button>
                        </form> 
                        <form action="{{ route('acao_extensao_pendencias.deliberacao_conext.gerar') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Gerar Deliberação</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection