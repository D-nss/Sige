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
                    Estamos quase lá! Para finalizar o processo de inscrição, é necessário que você confirme o seu endereço de e-mail. Por favor, realize essa confirmação o quanto antes, a fim de garantir a validade da sua inscrição dentro do prazo estabelecido.

A efetivação da sua inscrição só ocorrerá após a confirmação, para a qual enviamos um link para o seu endereço de e-mail.

Se não conseguir encontrar o e-mail, por favor, verifique também a sua pasta de Spam.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
