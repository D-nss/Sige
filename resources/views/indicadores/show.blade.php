@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Dados dos indicadores da unidade: <span class="text-secondary">{{$unidade->sigla}}</span>, ano base {{ $ano }} 
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="checkicon">
                <div class=" p-3 panel">
                    @include('indicadores._table')
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
