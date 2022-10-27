@extends('layouts.app')

@section('title', 'Edição da Ação Cultural')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item active">Editar Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-culturais"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> Editar Ação Cultural
        <small>
            Edição da Ação Cultural
        </small>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
          <div id="panel-1" class="panel">
              <div class="panel-hdr">
                  <h2>
                      1. Dados Iniciais <span class="fw-300"><i>Caracterização do Evento Cultural</i></span>
                  </h2>
              </div>
              <div class="panel-container show">
                  <div class="panel-content">
                      <form action="{{route('acao_cultural.update', ['acao_cultural' => $acao_cultural->id])}}" id="form_acao_cultural" method="POST">
                          @csrf
                          @method('put')
                          Em desenvolvimento
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

@endsection
