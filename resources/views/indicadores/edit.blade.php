@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Editar Indicadores da unidade: <span class="text-secondary">{{$unidade->sigla}}</span>, ano base {{ $ano }} 
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
                <form action="{{ url('/indicadores/' . $ano) }}" method="post">
                    @csrf
                    @method('put')
                    <div id="smartwizard" class="sw-main sw-theme-default p-4">

                        @include('indicadores._form')

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
