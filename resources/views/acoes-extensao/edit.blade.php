@extends('layouts.app')

@section('title', 'Alterar Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao">Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Alterar Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Listagem
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-edit'></i> Alterar Ação de Extensão
        <small>
            Alteração da Ação de Extensão
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Formulário <span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form action="{{route('acao_extensao.update', ['acao_extensao' => $acao_extensao->id])}}" id="form_acao_extensao" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('acoes-extensao._form')
                        <div class="row">
                            <div class="form-group mt-3 ml-3">
                                <a href="/acoes-extensao" class="btn btn-secondary btn-user ">
                                    <span class="icon text-white-50">
                                    <i class="fal fa-arrow-left"></i>
                                    </span>
                                    <span class="text">Cancelar</span>
                                </a>
                                {{--<button type="submit" class="btn btn-primary btn-user btn-verde">
                                    <i class="fal fa-check"></i> <b>Criar e Adicionar Datas</b>
                                </button>--}}
                                <button class="btn btn-primary" type="button" id="btn-editar-acao"><span class="icon text-white-50">
                                    <i class="fal fa-save"></i>
                                    </span>
                                    <span class="text">Salvar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="float-right m-3">
                    @if(isset($acao_extensao->ocorrencias) && $acao_extensao->ocorrencias->count() > 0)
                        <form action="{{route('acao_extensao.destroy', ['acao_extensao' => $acao_extensao->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                    @else
                        <form action="{{route('acao_extensao.desativar', ['acao_extensao' => $acao_extensao->id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Desativar</button>
                        </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
