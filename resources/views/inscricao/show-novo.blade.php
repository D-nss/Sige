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
        @if( isset($analise) && $analise == true )
            <span class="text-success"><i class='subheader-icon fal fa-address-card'></i> Análise da Inscrição</span>
            <small>
                Exibição dos dados da inscrição e análise
            </small>
        @else
            <span class="text-success"><i class='subheader-icon fal fa-address-card'></i> Visualização da Inscrição</span>
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
        @if( $userNaComissao && $inscricao->status == 'Relatório em Análise' && strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_fim_relatorio', $inscricao->edital_id)) )
        <div class="alert alert-warning fs-lg">
            Pendente de análise do relatório final
        </div>
        @endif
        <div class="card row">  
            
            <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="demo">
                    @if( (isset($avaliacaoResposta['analise']) && $avaliacaoResposta['analise'] == true )  ) 
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#analiseModal">Análise</button>
                    @elseif( (isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true) || (isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true) ) 
                        <a href='{{ url("/inscricao/$inscricao->id/avaliacao") }}' class="btn btn-success">Parecer</a>
                    @else 
                        <a href='javascript:history.back()' class="btn btn-primary">
                            <span class="icon text-white-50">
                                 <i class="fal fa-long-arrow-left"></i>
                             </span> Voltar</a>
                    @endif
                </div>

                @if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_divulgacao_previa', $inscricao->edital_id)) && ($inscricao->status == 'Indeferido' || $inscricao->status == 'Deferido') )
                <h2 class="text-muted fw-300">
                    Status 
                    <span class="badge badge-warning">
                        Em Análise
                    </span>
                </h2>
                @else
                <h2 class="text-muted fw-300">
                    Status 
                    <span class="badge badge-{{ $status[$inscricao->status] }}">
                        {{ $inscricao->status }}
                    </span>
                </h2>
                @endif
            </div>
            
                                            
            <div class="frame-wrap w-100">
                <div class="accordion" id="accordionExample">
                    @if(
                        isset($inscricao->arquivo_relatorio) 
                        && 
                        $inscricao->participantes->count() > 0 
                        && 
                        isset($inscricao->total_orcamento_realizado) 
                        && 
                        isset($inscricao->justificativa_orcamento_realizado) 
                        && 
                        isset($inscricao->arquivo_prestacao_contas)
                    )
                        <div class="card">
                            <div class="card-header" id="headingRecurso">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseRelatorioFinal" aria-expanded="false" aria-controls="collapseRelatorioFinal">
                                    <div class='icon-stack display-3 flex-shrink-0'>       
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                        <i class="far fa-clipboard-list-check icon-stack-1x opacity-100 color-info-500"></i>
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        Relatório Final
                                    </h4>
                                    <span class="ml-auto">
                                    <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                    </span>
                                    <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                    </span>
                                </span>
                                </a>
                            </div>
                            <div id="collapseRelatorioFinal" class="collapse show" aria-labelledby="headingRecurso" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="col-12">
                                        @if( 
                                            $userNaComissao && $inscricao->status == 'Relatório em Análise' 
                                            && 
                                            ( 
                                                strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_fim_relatorio', $inscricao->edital_id)) 
                                                || 
                                                $inscricao->edital->tipo == 'Fluxo Contínuo' 
                                            )
                                        )
                                            <div class="alert alert-warning fs-lg">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#avaliarRelatorio">Avaliar Relatório</button>
                                                
                                            </div>
                                            <div class="modal" tabindex="-1" id="avaliarRelatorio">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('edital.relatorio-final.analisar', ['inscricao' => $inscricao]) }}" method="post">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Analisar Relatório Final</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="">Status</label>
                                                                    <select class="form-control" name="relatorio_final_status">
                                                                        <option value="">Selecione ...</option>
                                                                        <option value="Aceito">Aceito</option>
                                                                        <option value="Negado">Negado</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Observação</label>
                                                                    <textarea class="form-control" name="relatorio_final_observacao" id="" rows="10"></textarea>
                                                                </div>                                                            
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Enviar</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="p-0">
                                            <h5>
                                                Resultados e Conclusão
                                                <small class="mt-0 mb-3">
                                                    <a href="{{ url('storage/' . $inscricao->arquivo_relatorio) }}" target="_blank" class="btn btn-danger"><i class="far fa-file-pdf mr-1"></i> Abrir PDF </a>
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="p-0">
                                            <h5>
                                            Total Orçado
                                                <small class="mt-0 mb-3 text-primary">
                                                R$ {{ number_format($inscricao->orcamento->sum('valor'), 2, ',', '.' )}}
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="p-0">
                                            <h5>
                                            Total Orçamento Realizado
                                                <small class="mt-0 mb-3 text-primary">
                                                R$ {{ number_format($inscricao->total_orcamento_realizado, 2, ',', '.' )}}
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="mt-3" style="width: 160px">
                                            <div class="p-0">
                                                <h6 class="bg-warning-200 p-3">
                                                Saldo
                                                    <small class="mt-0 mb-1 fs-xl">
                                                    R$ {{ number_format($inscricao->orcamento->sum('valor') - $inscricao->total_orcamento_realizado, 2, ',', '.') }}
                                                    </small>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="p-0">
                                            <h5>
                                                Justificativa do Orçamento Realizado
                                                <small class="mt-0 mb-3">
                                                {{ $inscricao->justificativa_orcamento_realizado }}
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="p-0">
                                            <h5>
                                                Comprovante Prestação de contas
                                                <small class="mt-0 mb-3">
                                                    <a href="{{ url('storage/' . $inscricao->arquivo_prestacao_contas) }}" target="_blank" class="btn btn-danger"><i class="far fa-file-pdf mr-1"></i> Abrir PDF </a>
                                                </small>
                                            </h5>
                                        </div>
                                        @if( !is_null($inscricao->relatorio_final_status) )
                                            <div class="p-0">
                                                <h5>
                                                    Status Relatório Final
                                                    <small class="mt-0 mb-3 ">
                                                        <span class="
                                                        badge 
                                                        @if($inscricao->relatorio_final_status == 'Aceito')
                                                            badge-success
                                                        @else
                                                            badge-danger
                                                        @endif
                                                        ">
                                                            {{ $inscricao->relatorio_final_status }}
                                                        </span>
                                                    </small>
                                                </h5>
                                            </div>
                                        @endif
                                        @if( !is_null($inscricao->relatorio_final_observacao) )
                                            <div class="p-0">
                                                <h5>
                                                    Observação Relatório Final
                                                    <small class="mt-0 mb-3">
                                                    {{ $inscricao->relatorio_final_observacao }}
                                                    </small>
                                                </h5>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-striped mt-4">
                                                <thead class="thead-light ">
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
                                                <tbody>
                                                    @foreach($inscricao->participantes as $participante)
                                                    <tr>
                                                        <td>{{ $participante->nome }}</td>
                                                        <td>{{ $participante->categoria }}</td>
                                                        <td>{{ $participante->ra }}</td>
                                                        <td>{{ $participante->unidade }}</td>
                                                        <td>{{ $participante->instituicao }}</td>
                                                        <td>{{ $participante->carga_semanal }}</td>
                                                        <td>{{ $participante->carga_total }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if( (strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_divulgacao_previa', $inscricao->edital_id))) && $notasAvaliacao )
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <div class='icon-stack display-3 flex-shrink-0'>       
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                    <i class="fal fa-credit-card icon-stack-1x opacity-100 color-info-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Resultado Prévio
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                    </span>
                                    <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseFour" class="collapse 
                        @if( (strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_fim_relatorio', $inscricao->edital_id))) )
                            show
                        @endif" aria-labelledby="headingFour" data-parent="#accordionExample">
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
                            <h1><i class="far fa-clipboard-list-check"></i> Nota Geral: {{ $inscricao->nota == null ? 00.00 : $inscricao->nota }}</h1>
                            <div class="mt-3">
                                
                                <div class="mt-3">
                                    <h4>Justificativa, Parecer e Notas</h4>
                                    @foreach($parecerAvaliacao as $parecer)
                                        <div class="mb-2">
                                            <div class="p-0">
                                                <h5>
                                                Parecer da avaliação:
                                                    <small class="mt-0 mb-3 text-primary">
                                                        {{ $parecer->parecer }}
                                                    </small>
                                                </h5>
                                            </div>
                                            <div class="p-0">
                                                <h5>
                                                Justificativa da nota:
                                                    <small class="mt-0 mb-3 text-primary">
                                                        {{ $parecer->justificativa }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        @foreach( $notasAvaliacao->filter(function ($nota) use ($parecer) {
                                                return $nota['user_id'] === $parecer->user_id;
                                            }) as $notas )
                                            <div class="mb-3">
                                                <span class="text-secondary fs-md fw-300">
                                                    {{ $notas['enunciado']}}
                                                </span>
                                                </br>
                                                <span class="">Nota: </span>
                                                <span class="fs-md fw-500">
                                                    {{ $notas['valor'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
                                    <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                    </span>
                                    <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse
                        @if( (strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_divulgacao_previa', $inscricao->edital_id))) )
                            show
                        @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                            {{ $inscricao->user->name }}
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
                                            @foreach($inscricao->areas as $areasTematicas)
                                                {{ $areasTematicas->nome }}
                                                @if ($inscricao->areas->last()->nome != $areasTematicas->nome) {{','}} @endif
                                            @endforeach
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Objetivo Desenvolvimento Sustentável
                                            <small class="mt-0 mb-3 text-muted">
                                            @foreach( $inscricao->ods as $value)
                                                <span class="badge badge-secondary px-2">{{ $value->nome }}</span>
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
                                            {{ $inscricao->municipio->uf }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?
                                            <small class="mt-0 mb-3 text-muted">
                                            Sim 
                                            </small>
                                            @if($inscricao->anexo_parceria)
                                                <a href='{{ url("storage/$inscricao->anexo_parceria") }}' target="_blank" class="btn btn-sm btn-danger mb-3">Comprovante</a>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Quantidade Alunos
                                            <small class="mt-0 mb-3 text-muted">
                                            {{ $inscricao->qtde_alunos }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Quantidade Alunos Pós-Graduação
                                            <small class="mt-0 mb-3 text-muted">
                                            {{ $inscricao->qtde_alunos_pg }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Quantidade Alunos Colégios Técnicos
                                            <small class="mt-0 mb-3 text-muted">
                                            {{ $inscricao->qtde_alunos_ct }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Link Projeto
                                            <small class="mt-0 mb-3 text-muted">
                                            {{ $inscricao->url_projeto }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Link Lattes
                                            <small class="mt-0 mb-3 text-muted">
                                            {{ $inscricao->url_lattes }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                        Resumo
                                            <small class="mt-0 mb-3 text-muted alert alert-info" role="alert">
                                            {!! nl2br( e( $inscricao->resumo ) ) !!}
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
                                            @if( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_divulgacao_previa', $inscricao->edital_id)) && $inscricao->status == 'Indeferido')
                                                {{ $inscricao->justificativa }}
                                            @endif
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
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                    <i class="fal fa-newspaper icon-stack-1x opacity-100 color-info-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Detalhamento
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                    </span>
                                    <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                @foreach($respostasQuestoes as $respostaQuestao)
                                <div class="col-12">
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
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                    <i class="fal fa-file-invoice-dollar icon-stack-1x opacity-100 color-info-500"></i>
                                </div>
                                <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                    Orçamento
                                </h4>
                                <span class="ml-auto">
                                    <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                    </span>
                                    <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                        <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                        <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
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
                    
                    <!-- <div class="card">
                        <div class="card-header" id="headingFour">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Collapsible Group Item #4
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                            <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                        </span>
                                        <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                            <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                        </span>
                                    </span>
                            </a>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> -->
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
                                <a href="javascript:history.back()" class="btn btn-secondary btn-user ">
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

                                <div>
                                    <div class="border p-3 mb-2 rounded d-none" id="criterios">
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
                                    <label for="analise_prev_just" class="fw-700" id="label-justificativa">Observação</label>
                                    <textarea name="justificativa" id="justificativa" rows="5" class="form-control mb-2"></textarea>
                                    <p style="color: #D0D3D4;" id="alerta-justificativa">Campo não obrigatório</p>
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
