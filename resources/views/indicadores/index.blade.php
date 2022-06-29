@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Gestão de indicadores da unidade <span class="text-secondary">{{$unidade->sigla}}</span>
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <a class="btn btn-success btn-lg btn-icon rounded-circle" href="{{ url('/indicadores/novo') }}"><i class="far fa-plus"></i></a> Adicionar Indicadores
            <div class="mt-3">
                @include('indicadores._lista_indicadores')
            </div>
        </div>
    </div>
</div>

@endsection
