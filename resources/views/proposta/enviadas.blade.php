@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Suas Propostas Enviadas</h1>

<div class="panel">
    <div class="row p-4">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover" id="dt-propostas">
                <thead>
                    <tr>
                        <th>Proposta</th>
                        <th>Coordenador</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="alert alert-secondary">
                        <td>Teste 1</td>
                        <td>Prof. Dr. José da Silva</td>
                        <td>Avaliado por Maria da Silva em 23/07/16 - 09:02</td>
                        
                    </tr>
                    <tr class="alert alert-success">
                        <td>Teste 1</td>
                        <td>Prof. Dr. José da Silva</td>
                        <td>Aprovado</td>
                    </tr>
                    <tr class="alert alert-warning">
                        <td>Teste 1</td>
                        <td>Prof. Dr. José da Silva</td>
                        <td>Pendente</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection