@extends('layouts.app')

@section('title', 'Aviso do Sistema de Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Gestão de Eventos</li>
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
                    Para concluir sua inscrição, é crucial confirmar seu endereço de e-mail o mais rápido possível, pois isso é necessário para validar sua inscrição dentro do prazo estipulado. A inscrição só será efetivada após a confirmação, e enviamos um link para seu e-mail para isso. Certifique-se de verificar sua pasta de Spam se não encontrar o e-mail..
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
