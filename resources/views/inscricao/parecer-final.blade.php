@extends('layouts.app')

@section('title', 'Cadastrar Parecer Final')

@section('content')
<h1>Parecer Final de Proposta</h1>

<div class="container">
    <div class="card row">
        <div class="col-md-12">
            <div class="card-body">                   
                <div id="swpropostashow">
                    <ul class="nav d-flex justify-content-start">
                        <li>
                            <a class="nav-link font-weight-bold font-size-16 " href="#step-1">
                                Dados
                            </a>
                        </li>
                        <li>
                            <a class="nav-link font-weight-bold font-size-16" href="#step-2">
                                Participantes
                            </a>
                        </li>
                        <li>
                            <a class="nav-link font-weight-bold font-size-16" href="#step-3">
                                Orçamento
                            </a>
                        </li>
                    </ul>
        
                    <div class="tab-content mt-3 px-3 pt-3">
                        <div id="step-1" class="tab-pane" role="tabpanel">
                            <h2 class="text-secondary">Dados do Relatório Técnico Final</h2>
                            <h3 class="text-secondary">Nome da Proposta</h3>
                            
                            <div class="row pt-3 border-bottom">
                                <div class="col-md-6">
                                    <p class="font-size-14"><span class="font-weight-bold">Coordenador: </span> Evandro</p>
                                    <p class="font-size-14"><span class="font-weight-bold">Título: </span> Projeto Teste</p>
                                    <p class="font-size-14"><span class="font-weight-bold">Tipo de Extensão: </span> Projeto</p>
                                </div>
                                <div class="col-md-6 ">
                                    <p class="font-size-14"><span class="font-weight-bold">Cidade: </span> Campinas</p>
                                    <p class="font-size-14"><span class="font-weight-bold">Estado: </span> São Paulo</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <iframe src="{{ asset('storage/upload/20220325085142623dacce0bbcc.pdf') }}" title="Titulo do Projeto / Programa" style="width: 100%; height: 100vh;" class="mb-3"></iframe>
                                </div>
                            </div>
                            
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100" id="dt-participantes">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>RA</th>
                                        <th>Unidade</th>
                                        <th>Instituição</th>
                                        <th>Carga Semanal</th>
                                        <th>Carga Total</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100 mb-2" id="dt-orcamento">

                                <thead>
                                    <tr>
                                        <th>Nome do Item</th>
                                        <th>Tipo do Item</th>
                                        <th>Descrição</th>
                                        <th>Justificativa</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>

                                <tbody>   
                                    <tr>
                                        <td>Informática</td>
                                        <td>Materias de Consumo</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Materias de Consumo</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Serviços Terceiros e Encargos</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Equipamentos e Instalações</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <span class="alert alert-success font-size-14 font-weight-bold">Total R$ 24.000,00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
