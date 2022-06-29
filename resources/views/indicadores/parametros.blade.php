@extends('layouts.app')

@section('title', 'Gerência dos parâmetros dos indicadores')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Gerência dos parâmetros dos indicadores
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-start align-items-center">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-secondary-400"></i>
                            <i class="far fa-cog icon-stack-1x opacity-100 color-secondary-500"></i>
                        </div>
                        <div class="ml-3">
                           @include('indicadores._form_parametros')
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-start align-items-center">
                        @include('indicadores._lista_parametros')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection