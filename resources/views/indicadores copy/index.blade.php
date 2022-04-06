@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <h1>Indicadores</h1>
            <hr>
            <a class="btn btn-primary" href="{{ url('/indicadores/novo') }}">Adicionar Indicadores</a>
            <hr>
            @foreach($indicadores as $indicador)
            <div class=" shadow p-3 mb-5 bg-white hv-light-green rounded d-flex justify-content-between">
                <h4>{{ $indicador->ano_base }}</h4>
                <div>
                @if( date('d/m/Y') <= $data_limite)
                    <a class="btn btn-secondary" href="{{ url('/indicadores/' . $indicador->ano_base . '/editar') }}">Editar</a>
                @endif
                <a class="btn btn-light-green" href="{{ url('/indicadores/' . $indicador->ano_base) }}">Ver</a>
                </div>
            </div>
            @endforeach            
        </div>
    </div>
</div>

@endsection