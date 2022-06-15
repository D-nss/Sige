@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Subcomissões Temáticas</h1>
        <!-- Begin Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('subcomissao-tematica') }}" method="post" class="row">
                                @csrf
                                
                                <div class="col-md-12">
                                    <label for="nome" class="font-weight-bold">Subcomissão Temática:</label>
                                    <input type="text" class="form-control mb-3" name="nome" id="nome" value="{{ old('nome') }}">
                                    
                                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                                        Adicionar
                                    </button>
                                </div>
                            </form>

                            <div class="mt-3">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Opções<th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subComissoesTematicas as $subComissaoTematica)
                                        <tr>
                                            <td>
                                                
                                                <div class="frame-heading text-secondary">
                                                {{ $subComissaoTematica->nome }}
                                                </div>
                                                <div class="frame-wrap">
                                                    <span class="font-color-light">Unidades</span>
                                                    <div class="demo">
                                                    @foreach($subComissaoTematica->unidades as $unidade)
                                                    
                                                        <span class="badge badge-primary">{{ $unidade->nome }}</span>
                                                            
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle" data-toggle="modal" data-target="#exampleModal{{ $subComissaoTematica->id }}">
                                                <i class="far fa-trash-alt"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $subComissaoTematica->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $subComissaoTematica->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ url('subcomissao-tematica/'. $subComissaoTematica->id) }}" method="POST">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel{{ $subComissaoTematica->id }}">Alerta</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <p>{{ $subComissaoTematica->nome }}</p>
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
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection