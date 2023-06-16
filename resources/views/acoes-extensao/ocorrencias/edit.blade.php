@extends('layouts.app')

@section('title', 'Alterar Ocorrência')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao">BAEC</a></li>
    <li class="breadcrumb-item active">Alterar Ocorrência</li>
    <li class="breadcrumb-item"><a href="#"><button type="button" class="btn btn-xs btn-outline-danger waves-effect waves-themed" data-toggle="modal" data-target="#modal{{ $acaoExtensaoOcorrencia->id }}">Excluir
    </button></a></li>
    <!-- Modal -->
    <div class="modal fade" id="modal{{ $acaoExtensaoOcorrencia->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $acaoExtensaoOcorrencia->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('acoes-extensao/ocorrencias/' . $acaoExtensaoOcorrencia->id )}}" method="post">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel{{ $acaoExtensaoOcorrencia->id }}">Alerta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        @csrf
                        @method('DELETE')
                        <p>Deseja realmente remover a ocorrência?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-edit'></i> Alterar Ocorrencia
        <small>
            {{$acaoExtensaoOcorrencia->acao_extensao->titulo}}
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
                    <form action="{{route('acao_extensao.ocorrencias.update', ['acaoExtensaoOcorrencia' => $acaoExtensaoOcorrencia->id])}}" id="form_ocorrencia" method="POST">
                        @csrf
                        @method('put')
                        @include('acoes-extensao.ocorrencias._form')
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
