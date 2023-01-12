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
        
        <span class="text-success"><i class='subheader-icon fal fa-address-card'></i> Visualização da Inscrição</span>
        <small>
            Exibição dos dados completos da inscrição
        </small>

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
            <div class="d-flex justify-content-between">
                <div class="demo">
                    <a href='javascript:history.back()' class="btn btn-primary">
                        <span class="icon text-white-50">
                                <i class="fal fa-long-arrow-left"></i>
                            </span> Voltar
                    </a>
                </div>
                <h2 class="text-muted fw-300">Status <span class="badge badge-{{ $status[$inscricao->status] }}">{{ $inscricao->status }}</span></h2>
            </div>
            
                                            
            <div class="frame-wrap w-100">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class='icon-stack display-3 flex-shrink-0'>
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                    <i class="fal fa-inbox icon-stack-1x opacity-100 color-info-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Dados do Projeto
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Título
                                            <small class="mt-0 mb-3 text-primary">
                                                {{ $inscricao->titulo }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Coordenador
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->user->name}}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Tipo de Extensão
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->tipo }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Áreas Temáticas
                                            <small class="mt-0 mb-3 text-muted">
                                                @foreach( $inscricao->areas as $area)
                                                    <span class="badge badge-info px-2">{{ $area->nome }}</span>
                                                @endforeach
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            Linha de Extensão
                                            <small class="mt-0 mb-3 text-muted" data-toggle="tooltip" data-placement="left" title="" data-original-title="{{ $inscricao->linha_extensao->descricao }}">
                                                {{ $inscricao->linha_extensao->nome }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Cidade
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->municipio->nome_municipio }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Estado
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->municipio->estado }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->parceria }}
                                            </small>
                                            @if( $inscricao->parceria == 'Sim' )
                                                <a href='{{ url("storage/$inscricao->anexo_parceria") }}' target="_blank" class="btn btn-sm btn-danger mb-3">Comprovante</a>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Link Projeto
                                            <small class="mt-0 mb-3 text-muted">
                                                <a href='{{ url("storage/$inscricao->url_projeto") }}' target="_blank" class="btn btn-link">{{ $inscricao->url_projeto }}</a>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Link Lattes
                                            <small class="mt-0 mb-3 text-muted">
                                                <a href='{{ url("storage/$inscricao->url_lattes") }}' target="_blank" class="btn btn-link">{{ $inscricao->url_lattes }}</a>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Resumo
                                            <small class="mt-0 mb-3 text-muted alert alert-info" role="alert">
                                                {{ $inscricao->resumo }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Palavras-Chave
                                            <small class="mt-0 mb-3 text-muted" >
                                                @foreach( explode(",", $inscricao->palavras_chaves) as $palavras)
                                                    <span class="badge badge-primary px-2">{{ $palavras }}</span>
                                                @endforeach
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Ressalvas
                                            <small class="mt-0 mb-3 text-muted">
                                                {{ $inscricao->justificativa }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-sm btn-danger"><i class="far fa-file-pdf mr-1"></i>Projeto em PDF</a>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                    <i class="fal fa-newspaper icon-stack-1x opacity-100 color-primary-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Detalhamento
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                @foreach( $respostasQuestoes as $respostaQuestao)
                                    <div class="col-12 @if($respostasQuestoes->last()->id != $respostaQuestao->id) border-bottom mb-2 @endif">
                                        <div class="p-0">
                                            <h5>
                                            {{ $respostaQuestao->enunciado }}
                                                <small class="mt-0 mb-3 text-muted">
                                                {!! nl2br( e($respostaQuestao->resposta) ) !!}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                                    <i class="fal fa-file-invoice-dollar icon-stack-1x opacity-100 color-warning-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Orçamento
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
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
                                <div class="mt-3 mb-3">
                                    <span class="alert alert-success font-size-14 fw-700">Total R$ {{ number_format($totalItens, 2, ',', '.') }}</span>
                                    <span class="alert alert-info font-size-14 fw-700">Total Disponível R$ {{ number_format($valorMaxPorInscricao - $totalItens, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-secondary-400"></i>
                                    <i class="far fa-user icon-stack-1x opacity-100 color-secondary-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Sub-comissão
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            Nome
                                            <small class="mt-0 mb-3">
                                                {{ is_null($inscricao->analista) ? '' : $inscricao->analista->name }}
                                            </small>
                                        </h5>
                                    </div>
                                    <div class="p-0">
                                        <h5>
                                            Unidade
                                            <small class="mt-0 mb-3">
                                            {{ is_null($inscricao->analista->unidade->sigla) ? '' :  $inscricao->analista->unidade->sigla }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                    <i class="fal fa-credit-card icon-stack-1x opacity-100 color-success-400"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Notas e Parecer
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                @if($inscricao->qtde_contemplacao)
                                    <div class="mb-2">
                                        <div class="p-0">
                                            <h1>
                                            <i class="far fa-percent"></i> Porcentagem de Contemplação:
                                                <small class="mt-0 mb-3 alert alert-success w-25 fw-700 font-size-16" >
                                                    {{ $inscricao->qtde_contemplacao }}
                                                </small>
                                            </h1>
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <div class="mt-3">
                                        <h4>Questões Avaliativas</h4>
                                            @foreach($notasAvaliacao as $notas)
                                                <div class="mb-3"><span class="text-secondary fs-md fw-300">{{ $notas->enunciado }}</span></br><span class="">Nota: </span><span class="fs-md fw-500">{{ $notas->valor }}</span></div>
                                            @endforeach
                                    </div>
                                    <div class="mt-3">
                                        <h4>Justificativa das Notas e Parecer</h4>
                                        @foreach($parecerAvaliacao as $parecer)
                                            <div class="mb-2">
                                                <div class="p-0">
                                                    <h5>
                                                    Justificativa das notas:
                                                        <small class="mt-0 mb-3 text-primary">
                                                            {{ $parecer->justificativa }}
                                                        </small>
                                                    </h5>
                                                </div>
                                                <div class="p-0">
                                                    <h5>
                                                    Parecer da avaliação:
                                                        <small class="mt-0 mb-3 text-primary">
                                                            {{ $parecer->parecer }}
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                    <i class="far fa-user icon-stack-1x opacity-100 color-danger-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Avaliadores(Pareceristas)
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-minus-circle text-danger"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-plus-circle text-success"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-6">
                                    @foreach($inscricao->avaliadores as $avaliadores)
                                    <div class="row @if($inscricao->avaliadores->last()->id != $avaliadores->id) border-bottom mb-2 @endif">
                                        <div class="p-0 col-md-6">
                                            <h5>
                                                Nome
                                                <small class="mt-0 mb-3">
                                                    {{ $avaliadores->name }}
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="p-0 col-md-6">
                                            <h5>
                                                Unidade
                                                <small class="mt-0 mb-3">
                                                    {{ $avaliadores->unidade->sigla }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
            </div>

        </div>
    </div>
</div>

@endsection
