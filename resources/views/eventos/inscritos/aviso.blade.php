@extends('layouts.app')

@section('title', 'Aviso do Sistema de Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Gestão de Eventos</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-check-circle'></i>Inscrição em Evento</span>
        <small>
        Confirmação de inscrição em evento.
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
            <div class="panel mt-3 p-3">
                <div class="flex-1">
                    <span class="f-lg font-color-light">Título do Evento</span>
                    <h1 class="font-italic fw-300 text-info">{{ $inscrito->evento->titulo }}</h1>
                </div>
                <div class="alert alert-warning">
                    <i class="far fa-exclamation-circle"></i>
                    Falta pouco. Para concluir sua inscrição, você precisa confirmar seu e-mail.
                    Confirme o quanto antes pois sua inscrição, respeitando o prazo das inscrições. Só será efetivada após a confirmação através do link enviado para seu endereço de e-mail.

                    Caso não localizá-lo, verifique sua caixa de Spam.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
