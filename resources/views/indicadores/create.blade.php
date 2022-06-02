@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<div class="container-fluid">
    @include('layouts._includes._status')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Adicionar indicadores da unidade <span class="text-secondary">{{$unidade->sigla}}</span>
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                @if( strtotime(date('Y-m-d')) <= strtotime($indicadoresParametros->data_limite) )
                <form action="{{ url('/indicadores') }}" method="post">
                    @csrf
                    <div id="smartwizard" class="sw-main sw-theme-default p-4">

                    @include('indicadores._form')

                    </div>
                </form>
                @else
                    <h4 class="text-light">Desculpe! O período de cadastro dos indicadores já se encerrou.</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

