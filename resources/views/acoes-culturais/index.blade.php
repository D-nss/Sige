@extends('layouts.app')

@section('title', 'Listagem das Ações Culturais')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item">Cultura</li>
    <li class="breadcrumb-item active">Listagem</li>
    <li class="breadcrumb-item"><a href="/acoes-culturais/novo"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Cadastrar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Ações de Cultura
        <small>
            Listagem das Ações Culturais cadastradas
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
                                    <form action="{{route('acao_cultural.filtrar')}}" id="form_filtro_acao_cultural" class="form-horizontal form-label-left" method="POST">
                                        @csrf
                                        @include('acoes-culturais._filter')
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
                                 <th class="text-uppercase text-muted py-2 px-3">Ação Cultural</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Segmento Cultural</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Coordenador</th>
                                <th class="text-uppercase text-muted py-2 px-3">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acoes_culturais as $acao_cultural)
                            <tr >
                                <td>{{$acao_cultural->id}}</td>
                                <td>
                                    <a href="/acoes-culturais/{{$acao_cultural->id}}" class="fs-lg fw-500 d-block">
                                        {{$acao_cultural->titulo}}
                                    </a>
                                    <div class="d-block text-muted fs-sm">
                                        Formato: {{$acao_cultural->tipo_evento}}
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    @foreach (explode(',', $acao_cultural->segmento_cultural) as $segmento_cultural)
                                            {{$segmento_cultural}}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    {{$acao_cultural->nome_coordenador}}
                                    <div class="text-muted small text-truncate">
                                        Unidade: <a href="/acoes-culturais/unidades/{{$acao_cultural->unidade->id}}" >{{$acao_cultural->unidade->sigla}}</a>
                                        <br>
                                    </div>
                                </td>
                                <td>
                                    <a href="/acoes-culturais/situacao/{{$acao_cultural->status}}">
                                        {{$acao_cultural->status}}
                                    </a>
                                    <div class="text-muted small text-truncate">
                                        Atualizado: {{$acao_cultural->updated_at->format('d/m/Y')}}
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
