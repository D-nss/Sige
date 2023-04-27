@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Indicadores</li>
    <li class="breadcrumb-item active">Gestão Indicadores</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Indicadores</span>
        <small>
        Gestão dos itens dos indicadores
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
            <a class="btn btn-success btn-lg btn-icon rounded-circle" href="{{ url('/indicadores-itens/novo') }}"><i class="far fa-plus"></i></a> Adicionar Indicadores
            <div class="mt-3">
                @include('indicadores.itens._table')
            </div>
        </div>
    </div>
</div>

@endsection
