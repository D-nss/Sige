@extends('layouts.app')

@section('title', 'Indicação de avaliador')

@section('content')
<h1>Indicação de Avaliador</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              @include('layouts._includes._status')

              @include('layouts._includes._validacao')
              <div class="card">
                  <div class="card-body">
                      <h4>Inscrição:</h4>
                      <h4 class="text-success">{{ $inscricao->titulo }}</h4>
                      <h4>Autor:</h4>
                      <h4 class="text-success">{{ $inscricao->user->name }}</h4>
                      <form action="{{ url('avaliador-por-inscricao/store') }}" method="post">
                        @csrf
                        <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">
                        <label for="avaliador_id">Avaliador</label>
                        <select class="form-control w-50" name="avaliador_id" id="avaliador_id" required>
                          <option value="">Selecione</option>
                          @foreach($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-3">Salvar</button>
                      </form>

                      <ul class="list-group w-50">
                        @foreach($inscricao->avaliadores as $avaliador)
                          <li class="list-group-item">
                            {{ $avaliador->name }}
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