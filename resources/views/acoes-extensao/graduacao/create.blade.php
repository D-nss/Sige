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
        <i class='subheader-icon fal fa-edit'></i> 
        Ações de Extensão
        <small>
            Indicação de membro do comitê em inscrição
        </small>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <!-- <div class="panel-hdr">
                    <h2>
                        
                    </h2>
                    <div class="panel-toolbar">
                        <a href="/acoes-extensao/novo" class="btn btn-success btn-block btn-pills waves-effect waves-themed"><i class="fal fa-plus-circle"></i> Nova Ação</a>
                    </div>
                </div> -->
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                @switch($acao_extensao->modalidade)
                                @case(1)
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Programa
                                    @break
                                    @case(2)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                    <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Projeto
                                    @break
                                    @case(3)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                    <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Curso
                                    @break
                                    @case(4)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                    <i class="fal fa-newspaper icon-stack-1x opacity-100 color-success-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Evento
                                    @break
                                    @case(5)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                    <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Prestação de Serviços
                                    @break
                                    @default
                                    @endswitch
                                    <small class="m-0 l-h-n">
                                        <b>Linha:</b> {{$acao_extensao->linha_extensao->nome}}
                                    </small>
                                </h5>
                                <div>
                                    @foreach ($acao_extensao->areas_tematicas as $area_tematica)
                                    <a href="/acoes-extensao/areas/{{$area_tematica->id}}"><span class="badge badge-success">{{$area_tematica->nome}}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('acoes-extensao/' . $acao_extensao->id) }}" class="btn btn-danger my-3">Ver Dados da Ação de Extensão</a>
                        @include('acoes-extensao.comite._form')
                        @if(isset($acao_extensao->comite_user_id))
                            <div class="w-50 mt-3 p-2 border-bottom">
                                {{ $acao_extensao->comite_user->name }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection