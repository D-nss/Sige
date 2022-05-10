@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Orçamento da Inscricão de Título: {{ $inscricao->titulo}}</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts._includes._status')

            @include('layouts._includes._validacao')
            <div class="card mb-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ url('orcamento')}}" method="post" >
                                @csrf
                                <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">

                                <label class="font-weight-bold" for="tipo_item">Tipo do Item:</label>
                                
                                <select class="form-control mb-3" name="tipo_item" id="tipo_item"  required >
                                    <option>Selecione o tipo</option>
                                    @foreach($tiposItens as $tipoItem)
                                        <option value="{{ $tipoItem->id }}">{{ $tipoItem->nome }}</option>
                                    @endforeach
                                </select>
                                
                                <label class="font-weight-bold" for="item">Item:</label>
                             
                                <select class="form-control mb-3" name="item" id="item" required >
                                    
                                </select>
                            
                                <label class="font-weight-bold" for="descricao">Descrição do Item:</label>
                                <input type="text" class="form-control mb-3" name="descricao" id="descricao" required>
                        
                                <label class="font-weight-bold" for="justificativa">Justificativa do Item:</label>
                                <textarea type="text" class="form-control mb-3" name="justificativa" id="justificativa" required></textarea>

                                <label class="font-weight-bold" for="valor">Valor solicitado:</label>
                                <input type="text" class="form-control mb-3" name="valor" id="valor" required>
                                
                                <button type="submit" class="btn btn-success btn-block">Inserir Item</button>
                                
                            </form>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-orcamento">
                                <thead>
                                    <tr>
                                        <th>Nome do Item</th>
                                        <th>Tipo do Item</th>
                                        <th>Descrição</th>
                                        <th>Justificativa</th>
                                        <th>Valor</th>
                                        <th>Operação</th>
                                    </tr>
                                </thead>

                                <tbody> 
                                    @if(isset($orcamentoItens))
                                        @foreach($orcamentoItens as $item)
                                            <tr>
                                                <td>{{ $item->item }}</td>
                                                <td>{{ $item->tipoitem}}</td>
                                                <td>{{ $item->descricao}}</td>
                                                <td>{{ $item->justificativa}}</td>
                                                <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                                                <td>
                                                    <form action='{{ url("/orcamento/$item->id") }}' method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <span class="alert alert-success font-size-14 font-weight-bold">Total R$ {{ number_format($totalItens, 2, ',', '.') }}</span>
                                <span class="alert alert-info font-size-14 font-weight-bold">Total Disponível R$ {{ number_format($valorMaxPorInscricao - $totalItens, 2, ',', '.') }}</span>
                            </div>
                            <a href="{{ url('inscricoes-enviadas') }}" class="btn btn-primary float-right">Finalizar</a>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection