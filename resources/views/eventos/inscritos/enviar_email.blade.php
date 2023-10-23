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
        <i class='subheader-icon fal fa-envelope'></i>Mensagem Inscrito
        <small>
        Envio de mensagem para o inscrito
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
            <div class="panel mt-3 p-3">
                <form action="{{ url('inscrito/enviar-email/' . $id) }}" method="post">
                    @csrf
                    <label for="tipo_mensagem" class="form-label">Tipo Mensagem</label>
                    <select class="form-control" name="tipo_mensagem">
                        <option value="">Selecione o tipo ...</option>
                        <option value="confirmar">Confirmação</option>
                        <option value="mensagem">Mensagem de Aviso</option>
                    </select>

                    <label for="tipo_mensagem" class="form-label mt-3">Tipo Mensagem</label>
                    <textarea class="form-control" name="mensagem" id="mensagem" cols="30" rows="10" placeholder="Escreva sua mensagem ..."></textarea>
                    <button class="btn btn-primary mt-3"><i class="fal fa-paper-plane"></i> Enviar</button>
                    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
