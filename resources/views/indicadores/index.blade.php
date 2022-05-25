@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">
    @include('layouts._includes._status')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Cadastro de indicadores da unidade <span class="text-secondary">{{$unidade->sigla}}</span>
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            Adicionar Indicadores <a class="btn btn-success btn-lg btn-icon rounded-circle" href="{{ url('/indicadores/novo') }}"><i class="far fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
        
            @foreach($indicadores as $indicador)
            <div class="p-3 mb-5 bg-white hv-light-green rounded d-flex justify-content-between">
                <h4>{{ $indicador->ano_base }}</h4>
                <div>
                <a class="btn btn-secondary" href="{{ url('/indicadores/' . $indicador->ano_base . '/editar') }}">Editar</a>
                <a class="btn btn-primary" href="{{ url('/indicadores/' . $indicador->ano_base) }}">Ver</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
