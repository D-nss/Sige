@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Recurso</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Recurso</span>
        <small>
        Argumentação do recurso da inscrição
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12">

        <div class="card row">
            <div class="card-body">
                <form action='{{ url("/inscricao/$inscricao->id/recurso") }}' method="post">
                    @csrf
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                            Título
                                <small class="mt-0 mb-3 text-primary">
                                {{ $inscricao->titulo }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                            Coordenador
                                <small class="mt-0 mb-3">
                                {{ $inscricao->user->name }}
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <a href='{{ url("/inscricao/$inscricao->id") }}' class="btn btn-danger" target="_blank">Ver inscrição completa</a>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="p-0">
                            <label for="argumentacao" class="form-label">Argumentação</label>
                            @if($inscricao->recurso)
                                <p class="mt-0 mb-3">{{ $inscricao->recurso->argumentacao }}</p>
                            @else
                                <textarea name="argumentacao" cols="30" rows="10" class="form-control"></textarea>
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        @if(!$inscricao->recurso)
                            <button class="btn btn-success">Enviar</button>
                        @endif
                        <a href="javascript:history.back()" class="btn btn-secondary btn-user float-right mt-2">
                            <span class="icon text-white-50">
                                <i class="fal fa-long-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <!-- /.container-fluid -->

@endsection
