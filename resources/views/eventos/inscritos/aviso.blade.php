@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

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
        QRCode de inscrição em evento.
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
                <h2 class="">Evento: <span class="text-primary">{{ $inscrito->evento->titulo }}</span></h2>
                <h3 class="alert alert-warning">Confirme sua presença através do e-mail cadastrado na inscrição</h3>                
            </div>
        </div>
    </div>
</div>

@endsection