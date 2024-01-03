@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Exensão</li>
    <li class="breadcrumb-item active">Listagem</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> 
        Ações de Extensão
        @if(isset($userNaComissaoConext)) 
            Pendentes de Aprovação (CONEXT)
        @elseif(isset($$userNaComissaoUnidades))
            Pendentes de Aprovação (UNIDADE)
        @endif
        <small>
            Listagem das Ações de Extensão
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
                        <a href="/acoes-extensao/novo" class="btn btn-success btn-block btn-pills waves-effect waves-themed"><i class="fal fa-plus-circle"></i> Nova Ação</a>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="accordion accordion-outline" id="js_demo_accordion-3">
                            <div class="card">
                                <div class="card-header">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#js_demo_accordion-3b" aria-expanded="false">
                                        <i class="fal fa-filter width-2 fs-xl"></i>
                                        Filtragem
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
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
                                    <th class="text-uppercase text-muted py-2 px-3">Modalidade / Linha / Área</th>
                                    <th class="text-uppercase text-muted py-2 px-3">ODS</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Coordenador</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Atualização</th>
                                    <th class="text-uppercase text-muted py-2 px-3">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acoes_extensao as $acao_extensao)
                                <tr>
                                    <td>{{$acao_extensao->id}}</td>
                                    <td>
                                        <div class="d-block">
                                            <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500">
                                                {{$acao_extensao->titulo}}
                                            </a>
                                            @if($acao_extensao->status == 'Aprovado' && $acao_extensao->status_avaliacao_conext == NULL)
                                            <span class="fw-300 color-warning-500"><i class="fal fa-exclamation-circle"></i><i> Pendente avaliação Conext!</i></span>
                                            @endif
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
                                    <td>
                                        @if($acao_extensao->status_comissao_graduacao === 'Sim' && $acao_extensao->user_id == Auth::user()->id)
                                            <a 
                                                href="{{ url('acoes-extensao/'. $acao_extensao->id .'/ocorrencias') }}" 
                                                class="btn btn-primary btn-pills waves-effect waves-themed fs-xl"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="" 
                                                data-original-title="Ocorrências"
                                            >
                                                <i class="fal fa-clipboard-list-check"></i>
                                            </a>
                                        @endif
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