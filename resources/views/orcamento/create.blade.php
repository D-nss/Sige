@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Orçamento da Inscricão de Título: {{ $inscricao->titulo}}</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include('layouts._includes._status')
            <div class="card mb-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ url('orcamento')}}" method="post" >
                                @csrf
                                <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">

                                <label class="font-weight-bold" for="tipo_item">Tipo do Item:</label>
                                
                                <select class="form-control mb-3" name="tipo_item" id="tipo_item"  required="" >
                                    <option>Selecione o tipo</option>
                                    <option value="1">Materiais de Consumo</option>
                                    <option value="2">Serviços Terceiros e Encargos</option>
                                    <option value="3">Equipamentos e Instalações</option>      
                                </select>
                                
                                <label class="font-weight-bold" for="item">Item:</label>
                             
                                <select class="form-control mb-3" name="item" id="item" required="" >
                                    <option value="1">Escritório/Papelaria</option>
                                    <option value="2">Informática</option>
                                    <option value="3">Fotografia/filmagem/arquivo</option>
                                    <option value="4">Esportes</option><option value="5">Didático</option>
                                    <option value="6">Gêneros Alimentícios</option
                                    ><option value="7">Equipamento Proteção Individual</option>
                                    <option value="8">Alimentação Pronta</option>
                                    <option value="9">Odontológico/hospitalar/ambulatorial</option>
                                    <option value="10">Produtos químicos, reagentes e assemelhados</option>
                                    <option value="11">Básico de construção/Elétrico/Hidráulico</option>
                                    <option value="12">Correios</option><option value="13">Vestuários</option>
                                    <option value="14">Outros Materiais de consumo</option>
                                </select>
                            
                                <label class="font-weight-bold" for="descricao">Descrição do Item:</label>
                                <input type="text" class="form-control mb-3" name="descricao" id="descricao" required="">
                        
                                <label class="font-weight-bold" for="justificativa">Justificativa do Item:</label>
                                <textarea type="text" class="form-control mb-3" name="justificativa" id="justificativa" required=""></textarea>

                                <label class="font-weight-bold" for="valoro">Valor solicitado:</label>
                                <input type="text" class="form-control mb-3" name="valor" id="valor" required="">
                                
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
                                                <td>{{ $item->tipo_item}}</td>
                                                <td>{{ $item->descricao}}</td>
                                                <td>{{ $item->justificativa}}</td>
                                                <td>R$ {{ $item->valor }}</td>
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
                                <span class="alert alert-info font-size-14 font-weight-bold">Total Disponível R$ {{ number_format($valorMaxPorInscricao, 2, ',', '.') }}</span>
                            </div>
                            <a href="{{ url('inscricao') }}" class="btn btn-primary float-right">Finalizar</a>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection