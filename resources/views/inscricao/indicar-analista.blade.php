@extends('layouts.app')

@section('title', 'Indicação de avaliador')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicação de Analista</span>
            <small>
              Indicação de analista para inscrição {{ $inscricao->titulo}}
            </small>
            <small class="font-weight-bold">
              Autor {{ $inscricao->user->name }}
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <form action="{{ url('inscricao/' . $inscricao->id . '/indicar-analista/store') }}" method="post">
                        @csrf
                        <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">
                        <label for="avaliador_id">Analista</label>
                        <select class="form-control w-50" name="analista_id" id="analista_id" required>
                          <option value="">Selecione</option>
                          @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-3">Salvar</button>
                      </form>
                      
                      @if($inscricao->analista)
                      <ul class="list-group w-50">
                          <li class="list-group-item">
                            {{ $inscricao->analista->name }}
                            <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle float-right" data-toggle="modal" data-target="#exampleModal{{ $inscricao->analista->id }}">
                            <i class="far fa-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $inscricao->analista->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $inscricao->analista->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ url('/inscricao/' . $inscricao->id .'/indicar-analista/delete') }}" method="POST">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{ $inscricao->analista->id }}">Alerta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            @csrf
                                            <input type="hidden" name="analista_id" value="{{ $inscricao->analista->id }}">
                                            <p>Deseja realmente remover o analista <strong>{{ $inscricao->analista->name }}</strong>?</p>
                                        
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
                      </ul>
                      @endif
                      <a href="{{ url('inscricao') }}" class="btn btn-primary btn-user float-right">
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