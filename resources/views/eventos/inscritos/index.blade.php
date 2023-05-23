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
        <span class="text-success"><i class='subheader-icon fal fa-clipboard-list-check'></i>Inscrições de Evento</span>
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
            <h1><i class="far fa-calendar-alt fa-1x"></i> {{ $evento->titulo }}</h1>
            
            @if($userNaComissao)
                @include('eventos.inscritos._incritos_comissao')  
            @endif
            @if($user->hasRole($evento->grupo_usuario))
                @include('eventos.inscritos._incritos_adm')
            @endif
        </div>
    </div>
</div>

@endsection
