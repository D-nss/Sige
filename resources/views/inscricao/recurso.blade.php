@extends('layouts.app')

@section('title', 'Recurso Inscrição')

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
                                <textarea name="argumentacao" cols="30" rows="10" class="form-control">{{ old('argumentacao') }}</textarea>
                                <span style="color: #D0D3D4;">(máx. 5000 caracteres)</span>
                            @endif
                        </div>
                    </div>
                    @if($inscricao->recurso)
                        <div class="col-12 mt-3">
                            <div class="p-0">
                                <h5>
                                    Status 
                                    <span class="badge badge-{{ $status[$inscricao->recurso->status] }}">{{ $inscricao->recurso->status }}</span>
                                </h5>
                            </div>
                        </div>
                    @endif
                    @if($userNaComissao && $inscricao->recurso->status == 'Aberto')
                        <!-- aprova trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aprovaModal">
                            Aprovar
                        </button>
                    @endif
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
                @if($inscricao->recurso)
                <!-- aprova modal -->
                <div class="modal" tabindex="-1" id="aprovaModal">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Aprovação de Recurso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action='{{ url("recurso/avaliar") }}' method="post" id="form-aprova-recurso">
                                @csrf
                                <input type="hidden" name="recurso_id" value="{{ $inscricao->recurso->id }}">
                                <label for="" class="fw-700">Opção</label>
                                <select class="form-control mb-2" name="status" id="status">
                                    <option value="">Selecione ...</option>
                                    <option value="Aceito">Aceito</option>
                                    <option value="Recusado">Recusado</option>
                                </select>

                                <button class="btn btn-success">
                                    
                                    <span class="spin-text">
                                        Enviar
                                    </span>
                                </button>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- fim aprova modal -->
                @endif
            </div>
        </div>
    </div>
</div>
        <!-- /.container-fluid -->

@endsection
