@extends('layouts.app')

@section('title', 'Gerência dos parâmetros dos indicadores')

@section('content')
<div class="container-fluid">
    @include('layouts._includes._status')
    @include('layouts._includes._validacao')

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
                            <form action="{{ url('indicadores-parametros') }}" method="post" id="indicadores-parametros-form">
                                @csrf
                                <input type="hidden" value="@if(isset($indicadoresParametros->id)){{$indicadoresParametros->id}}@endif" name="id">
                                <div class="form-row">
                                    <div class="col">
                                        <strong>
                                            <label for="ano_base">Ano Base</label>
                                        </strong>
                                        <input type="text" class="form-control disabled" name="ano_base" id="ano_base" maxlength="4" value="@if(isset($indicadoresParametros->ano_base)){{$indicadoresParametros->ano_base}}@endif" readonly>
                                    </div>
                                    <div class="col">
                                        <strong>
                                            <label for="data_limite">Data Limite</label>
                                        </strong>
                                        <input type="date" class="form-control disabled" name="data_limite" id="data_limite" value="@if(isset($indicadoresParametros->data_limite)){{$indicadoresParametros->data_limite}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <button class="btn btn-xs btn-primary waves-effect waves-themed" type="button" id="indicadores-parametros-editar-btn">Editar</button>
                                    <button class="btn btn-xs btn-success waves-effect waves-themed" type="button" id="indicadores-parametros-salvar-btn" disabled>Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection