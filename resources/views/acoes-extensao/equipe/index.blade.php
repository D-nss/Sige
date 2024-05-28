@extends('layouts.app')

@section('title', 'Gestão dos Membros')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">{{$acaoExtensaoOcorrencia->acao_extensao->titulo}}</li>
    <li class="breadcrumb-item">Ocorrencias</li>
    <li class="breadcrumb-item active">Gestão dos Membros</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span><i class='subheader-icon fal fa-list'></i>{{$acaoExtensaoOcorrencia->acao_extensao->titulo}}</span>
        <small>
        Gestão da equipe da Ocorrência
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
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <p>Ações de Extensão podem incluir membros de equipe em ocorrências, caso deseje adicionar um membro de equipe clique no botão abaixo.</p>
                        <div class="form-group">
                            <a href="{{ url('/acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe/novo') }}" class="btn btn-primary btn-pills waves-effect waves-themed">
                                <i class="fal fa-plus-circle"></i>
                                Novo Membro
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="mt-3">
                <div id="panel-1" class="panel mt-2">
                    <div class="panel-hdr">
                        <h2>
                            Para ver detalhes e atualizar os dados, clique sobre o registro na tabela abaixo
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <table class="table table-bordered table-hover" id="dt-propostas" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-Mail</th>
                                        <th>Instituição</th>
                                        <th>Vinculo</th>
                                        <th>Whatsapp</th>
                                        <th>Função</th>
                                        <th>Carga Horária</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($equipe as $membro)
                                    <tr>
                                        <td>
                                            <a 
                                                href="{{ url('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe/' . $membro->id . '/show') }}" 
                                                class="btn btn-xs btn-link fw-700 fs-xl"
                                            >
                                                {{ $membro->nome }}
                                            </a>    
                                        </td>
                                        <td>{{ $membro->email }}</td>
                                        <td>{{ $membro->instituicao }}</td>
                                        <td>{{ $membro->vinculo }}</td>
                                        <td>{{ $membro->whatsapp }}</td>
                                        <td>{{ $membro->funcao }}</td>
                                        <td>{{ $membro->carga_horaria }}</td>
                                        <td>
                                            <a 
                                                href="{{ url('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe/' . $membro->id . '/editar') }}" 
                                                class="btn btn-primary btn-pills waves-effect waves-themed fs-xl "
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="" 
                                                data-original-title="Editar Registro"
                                            >
                                                <i class="fal fa-file-edit"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-pills waves-effect waves-themed fs-xl " data-toggle="modal" data-target="#modal{{ $membro->id }}">
                                            <i class="fal fa-trash-alt"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal{{ $membro->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $membro->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ url('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id .'/equipe/' . $membro->id)}}" method="post">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel{{ $membro->id }}">Alerta</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                                @csrf
                                                                @method('DELETE')
                                                                <p>Deseja remover o membro <span class="fw-500">{{ $membro->nome }}</span>?</p>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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
