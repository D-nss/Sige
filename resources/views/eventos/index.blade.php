@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Gestão de Eventos</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-calendar'></i>Eventos
            <small>
                Gestão dos Eventos
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
                <a class="btn btn-primary waves-effect waves-themed" href="{{ url('/eventos/novo') }}"><span
                        class="fal fa-calendar-plus mr-1"></span> Novo Evento</a>
                <div class="mt-3">
                    <div class="frame-wrap w-100">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                        data-target="#collapseEventosAbertos" aria-expanded="true"
                                        aria-controls="collapseEventosAbertos">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                                            <i class="far fa-calendar-alt icon-stack-1x opacity-100 color-primary"></i>
                                            @if(count($eventosAbertos) > 0)
                                            <span class="badge badge-icon pos-top pos-right">{{count($eventosAbertos)}}</span>
                                            @endif

                                        </div>
                                        <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                            Eventos Abertos
                                        </h4>
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
                                <div id="collapseEventosAbertos" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        @include('eventos._table_abertos')
                                    </div>
                                </div>
                                <div class="card-header" id="headingOne">
                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                        data-target="#collapseEventosFechados" aria-expanded="false"
                                        aria-controls="collapseEventosFechados">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                                            <i class="far fa-calendar-minus icon-stack-1x opacity-100 color-primary"></i>
                                            @if(count($eventosEncerrados) > 0)
                                            <span class="badge badge-icon pos-top pos-right">{{count($eventosEncerrados)}}</span>
                                            @endif
                                        </div>
                                        <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                            Eventos Fechados
                                        </h4>
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
                                <div id="collapseEventosFechados" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        @include('eventos._table_encerrados')
                                    </div>
                                </div>
                                <div class="card-header" id="headingOne">
                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                        data-target="#collapseEventosCancelados" aria-expanded="false"
                                        aria-controls="collapseEventosCancelados">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                                            <i class="far fa-calendar-times icon-stack-1x opacity-100 color-primary"></i>
                                            @if(count($eventosCancelados) > 0)
                                            <span class="badge badge-icon pos-top pos-right">{{count($eventosCancelados)}}</span>
                                            @endif
                                        </div>
                                        <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                            Eventos Cancelados
                                        </h4>
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
                                <div id="collapseEventosCancelados" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        @include('eventos._table_cancelados')
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
