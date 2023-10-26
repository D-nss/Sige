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
            <i class='subheader-icon fal fa-calendar-day'></i>{{ $evento->titulo }}
            <small>
                Informações do membro da equipe participante do evento
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
                                    <div class="card-body">
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
                                            class="btn btn-primary"><span class="fal fa-file-certificate mr-1"></span> Certificado</a>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
