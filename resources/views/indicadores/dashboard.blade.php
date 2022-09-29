@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Indicadores</li>
    <li class="breadcrumb-item active">Gestão Indicadores</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-chart-bar'></i>Indicadores Dashboard</span>
        <small>
        Gestão de indicadores
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="mt-3">
                <div id="panel-1" class="panel" data-panel-lock="false" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                    <div class="panel-hdr">
                        <h2>
                            Preenchimento dos Indicadores nas Unidades
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content border-faded border-left-0 border-right-0 border-top-0">
                            <div class="panel-content p-0">
                               
                                <div class="row row-grid no-gutters">
                                    @forelse($indicadoresUnidades as $iu)
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 cursor-pointer" onclick="buscarUnidadesNaoCadastradasPorAno({{ $iu->ano_base}})">
                                        <div class="px-3 py-2 d-flex align-items-center">
                                            <div class="js-easy-pie-chart color-danger-300 position-relative d-inline-flex align-items-center justify-content-center" data-percent="{{ floor( ($iu->qtd_unidades * 100) / $unidades ) }}" data-piesize="100" data-linewidth="20" data-linecap="butt" data-scalelength="0">
                                                <div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-lg">
                                                    <span class="js-percent d-block text-dark"></span>
                                                </div>
                                            </div>
                                            <span class="d-inline-block ml-2 text-muted fs-xl">
                                                {{ $iu->ano_base}}
                                            </span>
                                            <div class="ml-auto d-inline-flex align-items-center">
                                                <h1><i class='subheader-icon fal fa-chart-line'></i></h1>
                                                <div class="d-inline-flex flex-column large ml-2">
                                                    <span class="d-inline-block badge badge-success opacity-75 text-center p-1 width-10">46</span>
                                                    <span class="d-inline-block badge badge-primary opacity-75 text-center p-1 width-10 mt-1">{{ $iu->qtd_unidades }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <p class="text-muted">Sem indicadores cadastrados</p>
                                    @endforelse
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xl-3">
                        <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500" >
                                    <span id="ano-selecionado">0</span>
                                    <small class="m-0 l-h-n">ANO</small>
                                </h3>
                            </div>
                            <i class="fal fa-calendar-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    <span id="total-unidades">{{ $unidades }}</span>
                                    <small class="m-0 l-h-n">TOTAL UNIDADES</small>
                                </h3>
                            </div>
                            <i class="fal fa-building position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="p-3 bg-danger-400 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    <span id="unidades-nao-enviadas">0</span>
                                    <small class="m-0 l-h-n">UNIDADES NÂO ENVIADAS</small>
                                </h3>
                            </div>
                            <i class="fal fa-times-circle position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                            <div class="">
                                <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                    <span id="unidades-enviadas">0</span>
                                    <small class="m-0 l-h-n">UNIDADES ENVIADAS</small>
                                </h3>
                            </div>
                            <i class="fal fa-check-circle position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="panel-4" class="panel">
                        <div class="panel-hdr">
                            <h2>
                                Unidades com indicadores não enviados 
                            </h2>
                            <div class="panel-toolbar">
                                <span class="text-muted fw-300 fs-xl">Ano <span class="badge badge-info" id="ano-selecionado"></span></span>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                    <thead class="bg-warning-200">
                                        <tr>
                                            <th>Unidade</th>
                                            <th>Sigla</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="unidades-nao-cadastradas-table">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Unidade</th>
                                            <th>Sigla</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- datatable end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
