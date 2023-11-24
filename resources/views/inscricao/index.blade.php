@extends('layouts.app')

@section('title', 'Gestão de Inscrições')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Listagem de Inscrições</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-list'></i>Inscrições</span>
        <small>
        Inscrições para serem analisadas, avaliadas ou finalizadas
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
            <div class="card-header">
                <h2>Inscrições para o edital <span class="text-dark fw-700">{{ $edital->titulo }}</span></h2>
            </div>
            <div class="card-body">
                @include('inscricao._table')
            </div>
                
        </div>
    </div>
</div>

@endsection