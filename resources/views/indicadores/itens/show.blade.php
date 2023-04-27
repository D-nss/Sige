@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Indicadores</li>
    <li class="breadcrumb-item active">Novo Indicador</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-list'></i>Indicadores</span>
        <small>
        Exibição dos dados do indicador
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
                <div class="frame-wrap w-100">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                        <i class="far fa-list icon-stack-1x opacity-100 color-success-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        Indicador: <span class="fw-400 text-primary">{{ $indicador->indicador}}</span>
                                    </h4>
                                    <span class="ml-auto disable">
                                        <span class="collapsed-reveal">
                                            <i class="fal fa-minus-circle text-danger"></i>
                                        </span>
                                        <span class="collapsed-hidden">
                                            <i class="fal fa-plus-circle text-success"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">   
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-12">Descrição</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400">
                                            {{ $indicador->descricao_indicador }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-12">Item Planes</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400">
                                            {{ $indicador->item_planes }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-12">Ativo</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400">
                                                <div class="badge badge-info">
                                                    {{ is_null($indicador->ativo) ? 'Não' : 'Sim' }}
                                                </div>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

