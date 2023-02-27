@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Gestão de Eventos</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-list'></i>Equipe do Evento</span>
        <small>
        Gestão da equipe do evento {{ $evento->titulo }}
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
            <a class="btn btn-success btn-lg btn-icon rounded-circle" href="{{ url('/evento/' . $evento->id . '/equipe/novo') }}"><i class="far fa-plus"></i></a> Adicionar Membro
            <div class="mt-3">
                <div class="frame-wrap w-100">
                    <div class="card">
                        <div class="card-body">
                        <table class="table table-bordered table-hover" id="dt-propostas" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-Mail</th>
                                    <th>Whatsapp</th>
                                    <th>Função</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>André Moreira</td>
                                    <td>aadilson@unicamp.br</td>
                                    <td>19 191919 1919</td>
                                    <td>Palestrante</td>
                                    <td>
                                        <button class="btn btn-info btn-xs">Ver</button>
                                        <button class="btn btn-danger btn-xs">Deletar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>André Moreira</td>
                                    <td>aadilson@unicamp.br</td>
                                    <td>19 191919 1919</td>
                                    <td>Palestrante</td>
                                    <td>
                                        <button class="btn btn-info btn-xs">Ver</button>
                                        <button class="btn btn-danger btn-xs">Deletar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>André Moreira</td>
                                    <td>aadilson@unicamp.br</td>
                                    <td>19 191919 1919</td>
                                    <td>Palestrante</td>
                                    <td>
                                        <button class="btn btn-info btn-xs">Ver</button>
                                        <button class="btn btn-danger btn-xs">Deletar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection