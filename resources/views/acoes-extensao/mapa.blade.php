@extends('layouts.app')

@section('title', 'Exibição da Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao">Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Mapa</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
            </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> Mapa das Ações de Extensão
        <small>
            Exibição da georreferenciação das Ações de Extensão. <span class="text-muted small text-truncate"> (Utilize o filtro para localizar melhor a ação desejada)</span>
        </small>
    </h1>
</div>

<div class="container-fluid">
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
                    <form action="{{route('acao_extensao.filtrar.mapa')}}" id="form_filtro_acao_extensao" class="form-horizontal form-label-left" method="POST">
                        @csrf
                        @include('acoes-extensao._filtro')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-g">
                <div class="card-body pb-0 px-4">
                    <x-maps-leaflet
                        :centerPoint="['lat' => -22.195240, 'long' => -48.433408]"
                        :zoomLevel="7"
                        :markers="$marcadores">
                    </x-maps-leaflet>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection