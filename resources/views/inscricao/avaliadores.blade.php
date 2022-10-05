@extends('layouts.app')

@section('title', 'Indicação de avaliador')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item">Avaliadores</li>
    <li class="breadcrumb-item active">Indicar Avaliadores</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Indicação de Avaliador</span>
        <small>
          Indicação dos avaliadores para inscrição {{ $inscricao->titulo}}
        </small>
        <small>
          Autor {{ $inscricao->user->name }}
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>
<div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <form action="{{ url('avaliador-por-inscricao/store') }}" method="post">
                        @csrf
                        <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">
                        <label for="avaliador_id">Avaliador</label>
                        <select class="form-control w-50" name="avaliador_id" id="avaliador_id" required>
                          <option value="">Selecione</option>
                          @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name - $user->sigla }}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-3">Salvar</button>
                      </form>

                      <ul class="list-group w-50">
                        @foreach($inscricao->avaliadores as $avaliador)
                          <li class="list-group-item">
                            <span class="fw-100 text-info font-size-18">{{ $avaliador->name }}</span>
                            <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle float-right" data-toggle="modal" data-target="#exampleModal{{ $avaliador->id }}">
                            <i class="far fa-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $avaliador->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $avaliador->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ url('avaliador-por-inscricao/delete') }}" method="POST">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $avaliador->id }}">Alerta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            @csrf
                                            <input type="hidden" name="inscricao_id" value="{{ $avaliador->pivot->inscricao_id }}">
                                            <input type="hidden" name="user_id" value="{{ $avaliador->pivot->user_id }}">

                                            <p>Deseja realmente remover o avaliador <strong>{{ $avaliador->name }}</strong>?</p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                      <a href="javascript:history.back()" class="btn btn-primary btn-user float-right">
                          <span class="icon text-white-50">
                              <i class="fal fa-long-arrow-left"></i>
                          </span>
                          <span class="text">Voltar</span>
                      </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection