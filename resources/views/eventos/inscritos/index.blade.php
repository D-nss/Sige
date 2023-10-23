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
        <i class='subheader-icon fal fa-clipboard-list-check'></i>Inscrições de Evento
        <small>
        Utilize as ferramentas abaixo para gerenciar os inscritos no evento.
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
            <h1><i class="far fa-calendar-alt fa-1x"></i> {{ $evento->titulo }} <a href="{{ url('inscritos/adm/email/' . $evento->id . '/novo') }}" class="btn btn-primary btn-lg btn-icon rounded-circle" >
                <i class="far fa-envelope"></i>
            </a></h1>



            @if($userNaComissao)
                @include('eventos.inscritos._inscritos_comissao')
            @endif
            @if($user->hasRole($evento->grupo_usuario))
                @include('eventos.inscritos._inscritos_adm')
            @endif
        </div>
    </div>
</div>

@endsection
