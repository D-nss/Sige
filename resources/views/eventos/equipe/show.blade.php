@extends('layouts.app')

@section('title', 'Detalhe do integrante')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Gestão de Eventos</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-list'></i>Eventos
            <small>
                Gestão dos eventos da PROEC
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
                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                            <i class="far fa-list icon-stack-1x opacity-100 color-success-500"></i>

                                        </div>
                                        <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                            Detalhes do Palestrante
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
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-12 flex-1">
                                            <span class="f-lg font-color-light">Título do Evento</span>
                                            <h1 class="fw-300 text-info">{{ $evento->titulo }}</h1>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Local</span>
                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $evento->local }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5 class="d-flex flex-column">
                                                    <span class="font-color-light font-size-14">Data</span>

                                                    <small class="mt-0 mb-3 font-size-16 fw-400">
                                                        <span class="font-color-light font-size-12">Início</span>
                                                        <br>
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->data_inicio)) }}
                                                        <br>
                                                        <span class="font-color-light font-size-12">Fim</span>
                                                        <br>
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->data_fim)) }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Nome Completo</span>
                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $membroEquipe->nome }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">E-Mail</span>
                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $membroEquipe->email }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Documento</span>
                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $membroEquipe->cpf }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        @if (!is_null($membroEquipe->whatsapp))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Whatsapp</span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ $membroEquipe->whatsapp }}
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!is_null($membroEquipe->instituicao))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Instituição</span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ $membroEquipe->instituicao }}
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!is_null($membroEquipe->funcao_evento))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Função</span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ $membroEquipe->funcao_evento }}
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{{ url('evento/' . $evento->id . '/equipe/' . $membroEquipe->id . '/certificado') }}"
                                            class="btn btn-danger">Gerar Certificado</a>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
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
