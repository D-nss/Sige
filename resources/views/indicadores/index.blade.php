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
                @forelse($indicadores as $indicador)
                <div class="p-3 mb-5 bg-white hv-light-green rounded d-flex justify-content-between">
                    <h4>{{ $indicador['ano_base'] }}</h4>
                    <div>
                        @if( strtotime( date('Y-m-d') ) <= strtotime($indicador['data_limite']) || $user->hasRole('indicadores-editar'))
                        <a class="btn btn-warning" href="{{ url('/indicadores/' . $indicador['ano_base'] . '/editar') }}">Editar <i class="far fa-edit"></i></a>
                        @endif
                        <a class="btn btn-info" href="{{ url('/indicadores/' . $indicador['ano_base']) }}">Ver <i class="far fa-eye"></i></a>
                    </div>
                </div>
                @empty
                <div id="panel-1" class="panel">
                    <h4 class="text-secondary m-3"><i class="far fa-exclamation-circle"></i> Você não possui indicadores cadastrados.</h4>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
