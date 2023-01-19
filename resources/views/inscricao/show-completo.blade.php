@extends('layouts.app')

@section('title', 'Dados da Inscrição')

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
                        <div class="card-header" id="headingDados">
                            <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseDados" aria-expanded="true" aria-controls="collapseDados">
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
                        <div id="collapseDados" class="collapse show" aria-labelledby="headingDados" data-parent="#accordionExample">
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
                        <div class="card-header" id="headingDetalhamento">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseDetalhamento" aria-expanded="false" aria-controls="collapseDetalhamento">
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
                        <div id="collapseDetalhamento" class="collapse" aria-labelledby="headingDetalhamento" data-parent="#accordionExample">
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
                        <div class="card-header" id="headingOrcamento">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseOrcamento" aria-expanded="false" aria-controls="collapseOrcamento">
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
                        <div id="collapseOrcamento" class="collapse" aria-labelledby="headingOrcamento" data-parent="#accordionExample">
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
                        <div class="card-header" id="headingArquivo">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseArquivo" aria-expanded="false" aria-controls="collapseArquivo">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                    <i class="far fa-file icon-stack-1x opacity-100 color-danger-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Arquivos
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
                        <div id="collapseArquivo" class="collapse" aria-labelledby="headingArquivo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="col-6">
                                    <form action="{{ url('/upload-arquivo')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <h4>Uploads de Arquivos</h4>
                                        <label for="nome_arquivo" class="form-label">Nome Arquivo</label>
                                        <input type="text" class="form-control mb-2" name="nome_arquivo" id="nome_arquivo" placeholder="Nome do arquivo" value="{{ old('nome_arquivo') }}">
                                        
                                        <div class="preview-zone hidden">
                                            <div class="box box-solid">
                                                <div class="box-header with-border">
                                                <div></div>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-secondary btn-xs remove-preview">
                                                    Limpar
                                                    </button>
                                                </div>
                                                </div>
                                                <div class="box-body" id="box-body">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                <p class="font-weight-bold">Arraste o pdf do projeto aqui ou clique para selecionar.</p>

                                            </div>
                                            <input type="file" name="arquivo-anexo" class="dropzone" id="arquivo" value="" required>

                                        </div>
                                        <input type="hidden" name="modulo" value="editais">
                                        <input type="hidden" name="inscricao_id" value="{{ $inscricao->id }}">
                                        <button class="btn btn-success mt-3">Enviar</button>
                                    </form>
                                   
                                    <div class="row border-bottom mb-2 mt-4">
                                        @foreach($arquivos as $arquivo)
                                        <div class="p-0 col-md-6">
                                            <h5>
                                                Nome Arquivo
                                                <small class="mt-0 mb-3">
                                                    {{ $arquivo->nome_arquivo }}
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="p-0 col-md-6">
                                            <h5>
                                                <a href='{{ url("storage/$arquivo->url_arquivo") }}' class="btn btn-danger" href="#" target="_blank">Abrir Arquivo</a>
                                            </h5>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingComissao">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseComissao" aria-expanded="false" aria-controls="collapseComissao">
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
                        <div id="collapseComissao" class="collapse" aria-labelledby="headingComissao" data-parent="#accordionExample">
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
                        <div class="card-header" id="headingNotas">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseNotas" aria-expanded="false" aria-controls="collapseNotas">
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
                        <div id="collapseNotas" class="collapse" aria-labelledby="headingNotas" data-parent="#accordionExample">
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
                                            <span class="d-inline-block text-truncate text-truncate-sm">{{ $notas->updated_at }}</span>
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
                        <div class="card-header" id="headingAvaliadores">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseAvaliadores" aria-expanded="false" aria-controls="collapseAvaliadores">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                    <i class="far fa-users icon-stack-1x opacity-100 color-danger-500"></i>
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
                        <div id="collapseAvaliadores" class="collapse" aria-labelledby="headingAvaliadores" data-parent="#accordionExample">
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
