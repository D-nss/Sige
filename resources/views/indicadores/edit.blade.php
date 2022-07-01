@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Indicadores</li>
    <li class="breadcrumb-item active">Editar Indicador</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Indicadores</span>
        <small>
        Editar Indicadores da unidade: <span class="text-secondary">{{$unidade->sigla}}</span>, ano base {{ $ano }} 
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
