@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<h1>Critérios do Edital</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              
              @include('layouts._includes._status')

              @include('layouts._includes._validacao')

              <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para cadastrar os critérios do Edital<span class="text-success"> @if( isset($edital) ) {{ $edital->titulo}} @endif</span></h6>
                </div>
                <div class="card-body">
                    
                    @include('criterios._form')

                    <table class="table table-bordered table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Edital</th>
                                <th>Critério</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( isset( $criterios ) )
                            @foreach( $criterios as $criterio )
                            <tr>
                                <td>{{ $criterio->id }}</td>
                                <td>{{ $criterio->descricao }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle" data-toggle="modal" data-target="#exampleModal{{ $criterio->id }}">
                                    <i class="far fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $criterio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $criterio->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ url('criterios/'. $criterio->id) }}" method="POST">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $criterio->id }}">Alerta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>{{ $criterio->descricao }}</p>
                                                    <p>Deseja realmente remover?</p>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                    
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                    <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary float-right">Finalizar</a>
                </div>
                
              </div>
              

            </div>
          </div>
        </div>

@endsection