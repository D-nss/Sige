@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Analise de Inscrição</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        @if( isset($analise) && $analise == true )
            <span class="text-success">Análise da Inscrição</span>
            <small>
                Exibição dos dados da inscrição e análise
            </small>
        @else
            <span class="text-success">Visualização da Inscrição</span>
            <small>
                Exibição dos dados da inscrição
            </small>
        @endif
        
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>

<div class="container-fluid">

     <div class="col-md-12">

        <div class="card row">
            <div class="card-body">                   
                <div id="swpropostashow">
                    <ul class="nav d-flex justify-content-between">
                        <li>
                            <a class="nav-link fw-700 font-size-16 " href="#step-1">
                                Dados Iniciais
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-2">
                                Áreas
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-3">
                                Linhas de Extensão
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-4">
                                Detalhamento
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-5">
                                Projeto em PDF
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-6">
                                Orçamento
                            </a>
                        </li>
                        @if( (isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true) || (isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true) )
                        <li>
                            <a class="nav-link fw-700 font-size-16" href="#step-7">
                                Avaliação
                            </a>
                        </li>
                        @endif
                    </ul>
        
                    <div class="tab-content mt-3 px-3 pt-3">
                        <div id="step-1" class="tab-pane pb-3" role="tabpanel">
                            <h2 class="text-primary fw-700">{{ $inscricao->titulo }}</h2>
                            <div class="row pt-3">
                                
                                <div class="col-md-6">
                                    <div class="card bg-white">
                                        <div class="card-body font-color-light">
                                            <p class="font-size-14"><span class="fw-700">Coordenador: </span> {{ $inscricao->user->name }}</p>
                                            <p class="font-size-14"><span class="fw-700">Tipo de Extensão: </span> {{ $inscricao->tipo }}</p>
                                            <p class="font-size-14"><span class="fw-700">Resumo: </span> {{ $inscricao->resumo }}</p>
                                            <p class="font-size-14"><span class="fw-700">Palavras Chaves: </span>
                                                @foreach( explode(",", $inscricao->palavras_chaves) as $palavras)
                                                    <span class="badge badge-danger badge-pill">{{ $palavras }}</span>
                                                @endforeach
                                            </p>
                                            <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 ">
                                    <div class="card bg-white">
                                        <div class="card-body font-color-light">
                                            <p class="font-size-14"><span class="fw-700">Cidade: </span> {{ $inscricao->municipio->nome_municipio }}</p>
                                            <p class="font-size-14"><span class="fw-700">Estado: </span> {{ $inscricao->municipio->uf }}</p>
                                            <p class="font-size-14"><span class="fw-700">Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?: </span> {{ $inscricao->parceria }}</p>
                                            @if($inscricao->anexo_parceria)
                                                <a href='{{ url("storage/$inscricao->anexo_parceria") }}' target="_blank" class="btn btn-sm btn-danger mb-3">Comprovante</a>
                                            @endif
                                            <p class="font-size-14"><span class="fw-700">Link Projeto: </span> {{ $inscricao->url_projeto }}</p>
                                            <p class="font-size-14"><span class="fw-700">Link Lattes: </span> {{ $inscricao->url_lattes }}</p>
                                            <p class="font-size-14"><span class="fw-700">Status: </span> <span  class="badge badge-{{ $status[$inscricao->status] }} badge-pill">{{ $inscricao->status }}</span></p>
                                            @if(!empty($inscricao->justificativa))
                                                <p class="font-size-14"><span class="fw-700">Justificativa: </span><span>{{ $inscricao->justificativa }}</span></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="step-2" class="tab-pane pb-3" role="tabpanel">
                            <h2 class="text-primary fw-700">Areas Temáticas</h2>
                            <div class="row pt-3 mb-3">
                                <div class="col-md-6">
                                    @foreach($inscricoesAreaTematica as $areasTematicas)
                                        <p class="font-size-16 font-color-light"><span class="fw-500">{{ $areasTematicas->nome }}</span></p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane pb-3" role="tabpanel">
                            <h2 class="text-primary fw-700">Linhas de Extensão</h2>
                            <div class="row pt-3 mb-3">
                                <div class="col-md-6">
                                    <p class="font-size-16 font-color-light"><span class="fw-500">{{ $linhaextensao->nome }}</span></p>
                                    <p class="font-color-light"><span>{{ $linhaextensao->descricao }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" class="tab-pane pb-3" role="tabpanel">
                            <h2 class="text-primary fw-700">Detalhamento</h2>
                            <div class="row pt-3 mb-3">
                                <div class="col-md-12">
                                    @foreach($respostasQuestoes as $respostaQuestao)
                                    <div class="rounded bg-f0 mb-2 p-2">
                                        <p class="font-size-14 font-color-light"><span class="fw-500">{{ $respostaQuestao->enunciado }}</span></p>
                                        <p class="font-color-light">{{ $respostaQuestao->resposta }}</p>
                                    </div> 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="step-5" class="tab-pane pb-3" role="tabpanel">
                            <iframe src='{{ url("storage/$inscricao->anexo_projeto") }}' title="Titulo do Projeto / Programa" style="width: 100%; height: 100vh;" class="mb-3"></iframe>
                        </div>
                        <div id="step-6" class="tab-pane" role="tabpanel">
                            <h2 class="text-primary fw-700">Orçamento</h2>
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
                                @foreach($itensOrcamento as $item)  
                                    <tr>
                                        <td>{{ $item->item }}</td>
                                        <td>{{ $item->tipoitem }}</td>
                                        <td>{{ $item->descricao}}</td>
                                        <td>{{ $item->justificativa}}</td>
                                        <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <span class="alert alert-success font-size-14 fw-700">Total R$ {{ number_format($totalItens, 2, ',', '.') }}</span>
                                <span class="alert alert-info font-size-14 fw-700">Total Disponível R$ {{ number_format($valorMaxPorInscricao - $totalItens, 2, ',', '.') }}</span>
                            </div>
                        </div>
                        @if( (isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true) ||  (isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true) )
                        <div id="step-7" class="tab-pane pb-3" role="tabpanel">
                            <h2 class="text-primary fw-700">Avaliação</h2>
                            @if($inscricao->status == 'Avaliado')
                                <h3 class="font-color-light">Já Avaliado</h3>
                            @elseif($inscricao->status == 'Deferido')
                            <form action='{{ url("/inscricao/$inscricao->id/avaliacao") }}' method="post" id="avaliacao-form">
                                @csrf

                                @if(isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true)
                                    <input type="hidden" name="tipo_avaliacao" value="parecerista">
                                @elseif( isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true)
                                    <input type="hidden" name="tipo_avaliacao" value="comissao1">
                                @endif

                                @foreach($questoesAvaliacao as $questaoAvaliacao)
                                <div class="bg-f0 rounded mb-2 p-2 w-100">
                                    <label for="" class="text-secondary font-size-14 fw-500">{{ $questaoAvaliacao->enunciado }}</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="3">
                                            <label class="form-check-label" for="inlineRadio3">3</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="4">
                                            <label class="form-check-label" for="inlineRadio1">4</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="5">
                                            <label class="form-check-label" for="inlineRadio2">5</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="6">
                                            <label class="form-check-label" for="inlineRadio3">6</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="7">
                                            <label class="form-check-label" for="inlineRadio2">8</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="9">
                                            <label class="form-check-label" for="inlineRadio3">9</label>
                                        </div>
                                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="10">
                                            <label class="form-check-label" for="inlineRadio3">10</label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </form>
                            @else
                                <h3 class="text-secondary">Não disponível para avaliação</h3>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @if( isset($avaliacaoResposta['analise']) && $avaliacaoResposta['analise'] == true )
                <!-- analise modal -->
                <div class="modal" tabindex="-1" id="analiseModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Finalizar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if($inscricao->status != 'Submetido' )
                                <h4>Já Avaliado</h4>
                                <a href="#" onclick="history.back()" class="btn btn-secondary btn-user ">
                                    <span class="icon text-white-50">
                                        <i class="fal fa-long-arrow-left"></i>
                                    </span>
                                    <span class="text">Voltar</span>
                                </a>
                            @else
                            <form action='{{ url("inscricao/$inscricao->id/avaliacao") }}' method="post" id="form-analise">
                                @csrf
                                <input type="hidden" name="tipo_avaliacao" value="subcomissao">
                                <label for="" class="fw-700">Opção</label>
                                <select class="form-control mb-2" name="status" id="status">
                                    <option value="">Selecione ...</option>
                                    <option value="Deferido">Deferido</option>
                                    <option value="Indeferido">Indeferido</option>
                                </select>

                                <div id="justificativa" class="d-none">
                                    <div class="border p-3 mb-2 rounded">
                                        <label for="" class="fw-700">Escolha os critérios de indeferimento:</label>
                                        <p>Pressione a tecla Ctrl para poder selecionar mais de uma opção</p>
                                        <select name="criterios[]" class="form-control" multiple>
                                        @if( isset($criterios) && !empty($criterios) )
                                            @foreach( $criterios as $criterio )
                                                <option value="{{ $criterio->descricao }}">{{ $criterio->descricao }}</option>
                                            @endforeach
                                        @endif
                                        </select>     
                                    </div>
                                    <label for="analise_prev_just" class="fw-700">Justificativa</label>
                                    <textarea name="justificativa" id="justificativa" rows="5" class="form-control mb-2"></textarea>

                                </div>
                                
                                <button class="btn btn-success loading">
                                    <div class="spinner-border spinner-border-sm d-none spin" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span class="spin-text">
                                        Enviar
                                    </span>
                                </button>

                            </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- fim analise modal -->
                @endif
            </div>
            
        </div>
    </div>
</div>

@endsection