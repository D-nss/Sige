@extends('layouts.app')

@section('title', 'Cadastro de uma Ação Cultural')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item active">Nova Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-culturais"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> Nova Ação Cultural
        <small>
            Cadastro de uma nova Ação Cultural
        </small>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
          <div id="panel-1" class="panel">
              <div class="panel-hdr">
                  <h2>
                      1. Dados Iniciais <span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                  </h2>
                  <div class="panel-toolbar">
                    <h2><span class="badge badge-info">NOVA AÇÃO</span></h2>
                </div>
              </div>
              <div class="panel-container show">
                  <div class="panel-content">
                      <form action="{{route('acao_cultural.store')}}" id="form_acao_cultural" method="POST">
                          @csrf
                          @include('acoes-culturais._form')
                          <div class="row">
                            <div class="form-group mt-3 ml-3">
                                <a href="/acoes-culturais" class="btn btn-secondary btn-user ">
                                    <span class="icon text-white-50">
                                    <i class="fal fa-arrow-left"></i>
                                    </span>
                                    <span class="text">Cancelar</span>
                                </a>
                                {{--<button type="submit" class="btn btn-primary btn-user btn-verde">
                                    <i class="fal fa-check"></i> <b>Criar e Adicionar Datas</b>
                                </button>--}}
                                <button class="btn btn-primary" type="submit"><span class="icon text-white-50">
                                    <i class="fal fa-save"></i>
                                    </span>
                                    <span class="text">Salvar e <i class="fal fa-plus"></i> datas (2. Datas e Locais)</span></button>
                            </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

@endsection
