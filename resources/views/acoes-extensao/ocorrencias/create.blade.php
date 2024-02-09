@extends('layouts.app')

@section('title', 'Inclusão de uma Ocorrência da Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao">{{$acao_extensao->titulo}}</a></li>
    <li class="breadcrumb-item active">Nova Ocorrência</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> Nova Ocorrência
        <small>
            Cadastro de uma nova Ocorrência
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Dados gerais<span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form action="{{route('acao_extensao.ocorrencias.store', ['acao_extensao' => $acao_extensao->id])}}" id="form_ocorrencia" method="POST">
                        @csrf
                        @include('acoes-extensao.ocorrencias._form')
                        <div class="row">
                            <div class="form-group mt-3 ml-3">
                                <a href="/acoes-extensaoacoes-extensao/{{$acao_extensao->id}}/ocorrencias" class="btn btn-secondary btn-user ">
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
                                    <span class="text">Salvar</span></button>
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
