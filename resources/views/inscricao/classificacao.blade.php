@extends('layouts.app')

@section('title', 'Classificação de incrições de Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Classficação de Inscrições</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon far fa-list-ol'></i>Inscrições</span>
        <small>
            Classificação das incrições do edital <strong class="text-primary">{{ $edital->titulo }}</strong>
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row card p-4">
        <div class="col-xl-12">

            <div class="card-body">
                @include('inscricao._table_classificacao')
            </div>
                
        </div>
    </div>
</div>

@endsection