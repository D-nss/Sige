@extends('layouts.app')

@section('title', 'Edição de Membro de Equipe')

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
            <div class="mt-3">
                <div class="frame-wrap w-100">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                                <div class="card-body">
                                        <form action="{{ url('evento/' . $evento->id . '/equipe/' . $membro->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @include('eventos.equipe._form')
                                        <button type="submit" class="btn btn-primary">
                                            <span class="fal fa-check mr-1"></span>Atualizar
                                        </button>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
