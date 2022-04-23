@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Avaliação de Proposta</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">
            <div class="card col-lg-12">
                <div class="card-body">
                    <div id="swpropostaavaliacao">
                        <ul class="nav d-flex justify-content-between">
                            <li>
                                <a class="nav-link font-weight-bold font-size-16 " href="#step-1">
                                    Dados
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-2">
                                    Áreas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-3">
                                    Linhas de Extensão
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-4">
                                    Dados Indicadores
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-5">
                                    Projeto em PDF
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-6">
                                    Orçamento
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-7">
                                    Avaliação
                                </a>
                            </li>
                        </ul>
            
                        <div class="tab-content mt-3 px-3 pt-3">
                            <div id="step-1" class="tab-pane" role="tabpanel">
                                <h2 class="text-secondary">Nome da Proposta</h2>
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

                                <div class="row py-3 mb-3 border-bottom">
                                    <div class="col-md-6">
                                        <p class="font-size-14"><span class="font-weight-bold">Número de pessoas da UNICAMP que serão envolvidas:: </span> 10</p>
                                        <p class="font-size-14"><span class="font-weight-bold">Número de pessoas externas que serão envolvidas: </span> 10</p>
                                        <p class="font-size-14"><span class="font-weight-bold">Realidade social, econômica e cultural da Comunidade: </span> Realidade teste</p>
                                        <p class="font-size-14"><span class="font-weight-bold">O projeto já está em execução?: </span> Não</p>
                                    </div>
                                    <div class="col-md-6 ">
                                        
                                        <p class="font-size-14"><span class="font-weight-bold">Grau de envolvimento da equipe com a Comunidade: </span> Não conhecem a comunidade</p>
                                        <p class="font-size-14"><span class="font-weight-bold">Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?: </span> Sim</p>
                                        <buttton class="btn btn-sm btn-danger">Comprovante</button>
                                    </div>
                                </div>

                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel">
                                <h2 class="text-secondary">Areas Temáticas</h2>
                                <div class="row pt-3 mb-3 border-bottom">
                                    <div class="col-md-6">
                                        <p class="font-size-14"><span class="font-weight-bold">Cultura</span></p>
                                        <p class="font-size-14"><span class="font-weight-bold">Meio Ambiente</span></p>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel">
                                <h2 class="text-secondary">Linhas de Extensão</h2>
                                <div class="row pt-3 mb-3 border-bottom">
                                    <div class="col-md-6">
                                        <p class="font-size-14"><span class="font-weight-bold">Segurança Alimentar e Nutricional</span></p>
                                        <p class="font-color-light"><span>Incentivo à produção de alimentos básicos, auto-abastecimento, agricultura urbana, hortas escolares e comunitárias, nutrição, educação para o consumo, regulação do mercado de alimentos, promoção e defesa do consumo alimentar</span></p>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel">
                                <h2 class="text-secondary">Dados Indicadores</h2>
                                <div class="row pt-3 mb-3 border-bottom">
                                    <div class="col-md-6">
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                    </div>
                                    <div class="col-md-6 ">
                                    <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                        <p class="font-size-14"><span class="font-weight-bold">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?: </span></p>
                                        <p class="font-color-light">Respostas da questão 1</p>
                                    </div>
                                </div>
                            </div>
                            <div id="step-5" class="tab-pane" role="tabpanel">
                                <iframe src="{{ asset('storage/upload/20220325085142623dacce0bbcc.pdf') }}" title="Titulo do Projeto / Programa" style="width: 100%; height: 100vh;" class="mb-3"></iframe>
                            </div>
                            <div id="step-6" class="tab-pane" role="tabpanel">
                                <table class="table table-bordered table-hover table-striped w-100 mb-2" id="dt-orcamento">

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
                                        <tr>
                                            <td>Informática</td>
                                            <td>Materias de Consumo</td>
                                            <td>2 Aparelhos celulares Samsung</td>
                                            <td>Atendimento Remoto</td>
                                            <td>R$ 6.000,00</td>
                                            <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Informática</td>
                                            <td>Materias de Consumo</td>
                                            <td>2 Aparelhos celulares Samsung</td>
                                            <td>Atendimento Remoto</td>
                                            <td>R$ 6.000,00</td>
                                            <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Informática</td>
                                            <td>Serviços Terceiros e Encargos</td>
                                            <td>2 Aparelhos celulares Samsung</td>
                                            <td>Atendimento Remoto</td>
                                            <td>R$ 6.000,00</td>
                                            <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Informática</td>
                                            <td>Equipamentos e Instalações</td>
                                            <td>2 Aparelhos celulares Samsung</td>
                                            <td>Atendimento Remoto</td>
                                            <td>R$ 6.000,00</td>
                                            <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <span class="alert alert-success font-size-14 font-weight-bold">Total R$ 24.000,00</span>
                            </div>
                            <div id="step-7" class="tab-pane" role="tabpanel">
                                <form action="">
                                    <label for="" class="text-secondary font-size-14">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="4">
                                            <label class="form-check-label" for="inlineRadio1">4</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="6">
                                            <label class="form-check-label" for="inlineRadio3">6</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="7">
                                            <label class="form-check-label" for="inlineRadio2">8</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="9">
                                            <label class="form-check-label" for="inlineRadio3">9</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="10">
                                            <label class="form-check-label" for="inlineRadio3">10</label>
                                        </div>
                                    </div>
                                    
                                    <label for="" class="text-secondary font-size-14">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="4">
                                            <label class="form-check-label" for="inlineRadio1">4</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="6">
                                            <label class="form-check-label" for="inlineRadio3">6</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="7">
                                            <label class="form-check-label" for="inlineRadio2">8</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="9">
                                            <label class="form-check-label" for="inlineRadio3">9</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="10">
                                            <label class="form-check-label" for="inlineRadio3">10</label>
                                        </div>
                                    </div>
                                    <label for="" class="text-secondary font-size-14">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="4">
                                            <label class="form-check-label" for="inlineRadio1">4</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="6">
                                            <label class="form-check-label" for="inlineRadio3">6</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="7">
                                            <label class="form-check-label" for="inlineRadio2">8</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="9">
                                            <label class="form-check-label" for="inlineRadio3">9</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="10">
                                            <label class="form-check-label" for="inlineRadio3">10</label>
                                        </div>
                                    </div>
                                    <label for="" class="text-secondary font-size-14 ">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="4">
                                            <label class="form-check-label" for="inlineRadio1">4</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="6">
                                            <label class="form-check-label" for="inlineRadio3">6</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio1" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio2" value="7">
                                            <label class="form-check-label" for="inlineRadio2">8</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="9">
                                            <label class="form-check-label" for="inlineRadio3">9</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="" id="inlineRadio3" value="10">
                                            <label class="form-check-label" for="inlineRadio3">10</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection