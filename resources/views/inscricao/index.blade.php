@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<div class="container-fluid">
    @include('layouts._includes._status')
    @include('layouts._includes._validacao')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Inscrições</span>
            <small>
            Inscrições para serem analisadas, avaliadas ou finalizadas
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>

    <div class="row p-4">
        <div class="col-md-12">
            @include('layouts._includes._status')
            <div class="card">

                <div class="card-body">
                    @include('inscricao._table')
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection