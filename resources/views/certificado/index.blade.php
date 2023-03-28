@extends('layouts.app')

@section('title', 'Verificar Certificado')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Certificado</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Certificado
        <small>
            Verificar autenticidade do certificado gerado
        </small>
    </h1>
</div>

<div class="container">
    @if(isset($encontrado))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-success-500">Dados Encontrados</div>

                <div class="card-body">
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                <span class="font-color-light font-size-14">Nome</span>
                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                {{ $encontrado->nome }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                <span class="font-color-light font-size-14">Tipo Documento</span>
                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                {{ $encontrado->tipo_documento }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                <span class="font-color-light font-size-14">Documento</span>
                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                {{ $encontrado->documento }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                <span class="font-color-light font-size-14">Evento</span>
                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                {{ $encontrado->evento->titulo }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    @if(isset($encontrado->titulo_trabalho) && $encontrado->status_arquivo == 'Aceito')
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                <span class="font-color-light font-size-14">Título Trabalho</span>
                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                {{ $encontrado->titulo_trabalho }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">Informe o Código do Certificado</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('certificado.validar') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Digite o código">
                        </div>
                        <button type="submit" class="btn btn-primary">Verificar</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

