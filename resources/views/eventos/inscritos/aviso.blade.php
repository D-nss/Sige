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
                <div class="d-block flex-shrink-0">
                    {!! $qrcode !!}
                    <div class="mt-3">
                        <a href="{{ url('inscritos/baixar_qrcode/' . $crypt) }}" class="btn btn-danger btn-block">Baixar QRCode</a> 
                    </div>
                </div>
                <div class="alert alert-warning">
                    <i class="far fa-exclamation-circle"></i> 
                    Confirme sua presença através do e-mail cadastrado na inscrição.
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection