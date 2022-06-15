@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Área Temática</h1>
        <!-- Begin Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('areas-tematicas') }}" method="post" class="row">
                                @csrf
                                
                                <div class="col-md-12">
                                    <label for="nome" class="font-weight-bold">Área Temática:</label>
                                    <input type="text" class="form-control mb-3" name="nome" id="nome">
                                    
                                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                                        Adicionar
                                    </button>
                                </div>
                            </form>

                            <div class="mt-3">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Área Temática</th>
                                            <!-- <th>Unidades<th>
                                            <th>Comissão</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($areasTematicas as $areaTematica)
                                        <tr>
                                            <td>{{ $areaTematica->nome }}</td>
                                            <!-- <td>
                                                <button class="btn btn-info m-1" data-toggle="modal" data-target="#unidadesModal">Unidades</button>
                                                <ul class="list-group list-group-horizontal-sm">
                                                    <li class="list-group-item list-group-item-primary">
                                                        FCF 
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        FCM
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        FEF
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        FENF
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        FOP
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        IB
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                               
                                                <div class="modal fade" id="unidadesModal" tabindex="-1" aria-labelledby="unidadesModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="unidadesModalLabel">Unidades</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="">
                                                                @csrf
                                                                <label for="unidade_id">Unidade</label>
                                                                <select class="form-control" name="unidade_id">
                                                                    <option value="">Selecione ... </option>
                                                                    <option value="">FCF</option>
                                                                    <option value="">FCM</option>
                                                                    <option value="">FEF</option>
                                                                    <option value="">FENF</option>
                                                                    <option value="">FOP</option>
                                                                    <option value="">IB</option>
                                                                </select>
                                                                <button class="btn btn-success mt-3">Adicionar</button>
                                                            </form>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-warning m-1" data-toggle="modal" data-target="#comissaoModal">Comissão</button>
                                                <ul class="list-group list-group-horizontal-sm">
                                                    <li class="list-group-item list-group-item-primary">
                                                        Prof. Dr. José da Silva
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                    <li class="list-group-item list-group-item-primary">
                                                        Prof. Dr. Maria da Silva
                                                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </li>
                                                </ul>
                                                
                                                <div class="modal fade" id="comissaoModal" tabindex="-1" aria-labelledby="comissaoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="comissaoModalLabel">Comissão</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="">
                                                                <label for="user_id">Usuário</label>
                                                                <select class="form-control" name="user_id">
                                                                    <option value="">Selecionar ...</option>
                                                                    <option value="">Prof. Dr. José Maria</option>
                                                                    <option value="">Prof. Dr. Maria José</option>
                                                                </select>
                                                                <button class="btn btn-success mt-3">Adicionar</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> -->
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