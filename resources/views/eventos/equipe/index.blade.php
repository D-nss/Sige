@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Gestão de Eventos</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-calendar-edit'></i>Equipe do Evento
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
                <a class="btn btn-primary" href="{{ url('/evento/' . $evento->id . '/equipe/novo') }}"><span
                        class="fal fa-plus mr-1"></span>Adicionar Membro</a>
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
                                            <th>Palestra</th>
                                            <th>Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipe as $membro)
                                            <tr>
                                                <td>{{ $membro->nome }}</td>
                                                <td>{{ $membro->email }}</td>
                                                <td>{{ $membro->whatsapp }}</td>
                                                <td>{{ $membro->funcao_evento }}</td>
                                                <td>{{ $membro->titulo_palestra }}</td>
                                                <td>
                                                    <a href="{{ url('evento/' . $evento->id . '/equipe/' . $membro->id . '/editar') }}"
                                                        class="btn btn-primary btn-xs">Editar</a>
                                                    <a href="{{ url('evento/' . $evento->id . '/equipe/' . $membro->id . '/show') }}"
                                                        class="btn btn-primary btn-xs">Ver</a>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                        data-target="#modal{{ $membro->id }}">
                                                        Remover
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal{{ $membro->id }}" tabindex="-1"
                                                        aria-labelledby="modalLabel{{ $membro->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form
                                                                action="{{ url('evento/' . $membro->evento->id . '/equipe/' . $membro->id) }}"
                                                                method="post">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modalLabel{{ $membro->id }}">Alerta</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <p>Deseja remover o membro <span
                                                                                class="fw-500">{{ $membro->nome }}</span>?
                                                                        </p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Fechar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary"><span class="fal fa-check mr-1"></span>Confirmar
                                                                            remoção</button>
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
