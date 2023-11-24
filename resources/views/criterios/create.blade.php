@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Critérios</li>
    <li class="breadcrumb-item active">Adicionar Critérios</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Critérios</span>
        <small>
        Cadastro dos critérios para o edital <span class="text-secondary">{{$edital->titulo}}</span>
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
            <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para cadastrar os critérios do Edital<span class="text-success"> @if( isset($edital) ) {{ $edital->titulo}} @endif</span></h6>
            </div>
            <div class="card-body">
                
                @include('criterios._form')

                @include('criterios._list')

                <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary btn-pills waves-effect waves-themed float-right">
                    <i class="far fa-paper-plane"></i>
                    <div class="spinner-border spinner-border-sm d-none spin" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="spin-text">
                        Finalizar
                    </span>    
                </a>
            </div>
            
            </div>
            

        </div>
    </div>
</div>

@endsection