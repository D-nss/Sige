@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Classificação Propostas Edital Teste 2</h1>

<div class="panel">
    <div class="row p-4">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover" id="dt-classificacao">
                <thead>
                    <tr>
                        <th>Aprovado?</th>
                        <th>Título</th>
                        <th>Nota</th>
                        <th>Orçamento</th>
                        <th>Acumulado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                        </td>
                        <td>Tempo Profundo: levando geociências para fora da universidade</td>
                        <td>120</td>
                        <td>R$ 7.000,00</td>
                        <td>R$ 7.000,00</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                        </td>
                        <td>Tempo Profundo: levando geociências para fora da universidade</td>
                        <td>120</td>
                        <td>R$ 7.000,00</td>
                        <td>R$ 7.000,00</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                        </td>
                        <td>Tempo Profundo: levando geociências para fora da universidade</td>
                        <td>120</td>
                        <td>R$ 7.000,00</td>
                        <td>R$ 7.000,00</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                        </td>
                        <td>Tempo Profundo: levando geociências para fora da universidade</td>
                        <td>120</td>
                        <td>R$ 7.000,00</td>
                        <td>R$ 7.000,00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection