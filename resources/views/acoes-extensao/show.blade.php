@extends('layouts.app')

@section('title', 'Exibição da Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao"> Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Detalhes da Ação</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
@if($acao_extensao->status == 'Rascunho')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação de Extensão inserida/atualizada, agora necessita que ela seja submetida para apreciação pela Unidade, isso pode ser feito através do botão <span class="fw-700">Enviar para Apreciação</span></span>
        </div>   
    </div>
</div>
@endif


@if($userNaComissao && $acao_extensao->user_id != $user->id && $acao_extensao->status == 'Pendente')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação de Extensão foi Submetida, e está pendende de aprovação pela Unidade</span><br>
            <span class="h5">Para prosseguir com a análise clique no botão <strong class="fw-700">Apreciar</strong></span><br>
            <span class="h5">Caso deseje mandar uma mensagem ao coordenador com orientações, acesse a sessão de comentários ao final desta página.</span>
        </div>
        
        <button type="button" class="btn btn-warning btn-w-m fw-500 btn-sm"  data-toggle="modal" data-target="#modal-apreciacao">Apreciar</button>
        
        <!--a href="/acoes-extensao/{{$acao_extensao->id}}/aprovar" class="btn btn-warning btn-w-m fw-500 btn-sm"  aria-label="Close">Aprovar</a-->
    </div>
</div>
<!-- Modal Large -->
<div class="modal fade" id="modal-apreciacao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apreciação de Ação de Extensão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <form action="{{ route('acao_extensao.aprovar', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-body">
                    <input type="hidden" id="acao_extensao_id" name="acao_extensao_id" value="{{ $acao_extensao->id }}">

                    <div class="form-group">
                        <label class="form-label" for="parecer_extensao">Descrição (Parecer)</label>
                        <textarea name="parecer_extensao" class="form-control" cols="30" rows="10" max="1000" placeholder="Digite aqui seu parecer. Limite de 1000 caracteres.">{{ old('parecer_extensao')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="simpleinput">De Acordo</label>
                        <select name="aceite_extensao" class="form-control w-50">
                            <option value="">Selecione ...</option>
                            <option value="Sim" @if (old('aceite_extensao') == 'Sim')
                                selected
                            @endif>Sim</option>
                            <option value="Não" @if (old('aceite_extensao') == 'Não')
                                selected
                            @endif>Não</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary wave-effect" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary wave-effect">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
        

@if(
    isset($acao_extensao->comite_user_id)
    &&
    $acao_extensao->comite_user_id == $user->id
    &&
    is_null($acao_extensao->parecer_comite)
    &&
    is_null($acao_extensao->aceite_comite)
)
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">
            Ação de Extensão aprovada pela comissão de extensão, pendente de análise do comitê consultivo
            </span><br>
            <span class="h5">
            Para prosseguir com sua análise clique no botão <strong>Parecer</strong>
            </span>
            <span class="h5">Caso deseje mandar uma mensagem ao coordenador com orientações, acesse a sessão de comentários ao final desta página.</span>
        </div>
        <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm"  data-toggle="modal" data-target="#modal-parecer-comite">Parecer</button>
    </div>
</div>
<!-- Modal Large -->
<div class="modal fade" id="modal-parecer-comite" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Emissão de Parecer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <form action="{{ url('acoes-extensao-comite-consultivo/'. $acao_extensao->id .'/parecer')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="acao_extensao_id" name="acao_extensao_id" value="{{ $acao_extensao->id }}">

                    <div class="form-group">
                        <label class="form-label" for="parecer_comite">Descrição (Parecer)</label>
                        <textarea name="parecer_comite" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="simpleinput">De Acordo</label>
                        <select name="aceite_comite" class="form-control w-50">
                            <option value="">Selecione ...</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary wave-effect" data-dismiss="modal">Fecha</button>
                    <button type="submit" class="btn btn-primary wave-effect">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


<div class="row">
    <div class="col-xl-12">
        <div id="panel-3" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <img src="{{ asset('smartadmin-4.5.1/img/387.png') }}" alt="Icon"> {{$acao_extensao->titulo}}   
                            <div class="row mt-3">
                                <div class="col-xl-12">                                    
                                    @if($acao_extensao->modalidade == 1 && $acao_extensao->aceite_comite == 'Sim' && $acao_extensao->status_comissao_graduacao == 'Sim' && $acao_extensao->status_avaliacao_conext == 'Reconhecido' && $acao_extensao->status == 'Aprovado')
                                        <span class="badge badge-success badge-pill">Publicada</span>bg-success
                                    @elseif($acao_extensao->modalidade == 1 && $acao_extensao->aceite_comite == 'Sim' && is_null($acao_extensao->status_comissao_graduacao) && $acao_extensao->status_avaliacao_conext == 'Reconhecido' && $acao_extensao->status == 'Aprovado')
                                        <span class="badge badge-success badge-pill">Publicada</span>
                                    @elseif($acao_extensao->ciencia_status == 'Reconhecido' && $acao_extensao->status == 'Aprovado')
                                        <span class="badge badge-success badge-pill">Publicada</span>
                                    @elseif ( is_null($acao_extensao->satus_avaliacao_conext) && $acao_extensao->modalidade == 1 && $acao_extensao->status == 'Aprovado' )
                                        <span class="badge badge-warning badge-pill">Reconhecimento em Andamento na ProEC </span>
                                    @elseif ( is_null($acao_extensao->ciencia_status) && $acao_extensao->modalidade != 1  && $acao_extensao->status == 'Aprovado' )
                                        <span class="badge badge-warning badge-pill">Reconhecimento em Andamento na ProEC </span>
                                    @elseif($acao_extensao->status == 'Pendente')
                                        <span class="badge badge-warning badge-pill">Registro em Andamento na Unidade</span>
                                    @elseif($acao_extensao->status == 'Rascunho')
                                        <span class="badge badge-secondary badge-pill">Rascunho</span>
                                    @endif

                                    <span class="badge badge-primary badge-pill">
                                        @switch($acao_extensao->modalidade)
                                            @case(1)
                                                Programa
                                                @break
                                            @case(2)
                                                Projeto
                                                @break
                                            @case(4)
                                                Evento
                                                @break
                                            @case(5)
                                                Prestação de Serviço
                                                @break
                                        @endswitch
                                    </span>

                                    <span class="badge badge-primary badge-pill">
                                        {{ $acao_extensao->linha_extensao->nome }}
                                    </span>

                                    @if(!is_null($acao_extensao->programa))
                                    <span class="text-muted">
                                        Vinculado ao Programa 
                                        <span class="fw-700">
                                            {{ $acao_extensao->programa->titulo }}
                                        </span>
                                    </span>
                                    @endif

                                    <div class="row mt-3">
                                        <div class="col-xl-12">
                                            <span class="text-muted small mr-3"> 
                                                Cadastrado em: 
                                                <span class="fw-700">
                                                    {{$acao_extensao->created_at->format('d/m/Y')}}
                                                </span> 
                                            </span> 
                                            <span class="text-muted small"> 
                                                Atualizado em: 
                                                <span class="fw-700">
                                                    {{$acao_extensao->updated_at->format('d/m/Y')}}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </h1>
                    </div>
                <div class="border-top mb-5 py-3">
                    <div class="row">
                        @include('acoes-extensao.statusbar')
                    </div>
                    @if (isset($acao_extensao->parecer_extensao) && ($acao_extensao->user->id == $user->id || request()->user->comissaoExtensao()))
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="alert alert-warning">
                                <h2><img src="{{ asset('smartadmin-4.5.1/img/391.png') }}" class="mr-3" alt="Icon">Última Mensagem da Comissão de Extensão da Unidade</h2>
                                <p class="text-dark">{{ $acao_extensao->parecer_extensao }}</p>
                                <p class="text-muted">Por <span class="fw-700">{{ $acao_extensao->aprovado->name }} ({{ $acao_extensao->aprovado->email }})</span> em <span class="fw-700">{{ date('d/m/Y', strtotime($acao_extensao->updated_at)) }}</span></p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mt-5">
                        <div class="col-lg-9">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Objetivos de Desenvolvimento Sustentável(ODS) 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        @foreach ($acao_extensao->objetivos_desenvolvimento_sustentavel as $ods)
                                        <span class="font-italic">{{$ods->nome}}</span>
                                        @endforeach
                                    </small>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Link Externo 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        <a href="{{$acao_extensao->url}}" target="_blank" >{{$acao_extensao->url}}</a>
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-9">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Áreas Temáticas 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        @foreach ($acao_extensao->areas_tematicas as $at)
                                        <span class="font-italic">{{$at->nome}}</span>
                                        @endforeach
                                    </small>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Arquivo do Projeto 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-1 text-muted">
                                        <a href='{{ url("storage/$acao_extensao->arquivo") }}' class="" target="_blank" >{{ $acao_extensao->titulo }} - Proposta</a>
                                        </small>
                                    <small class="mt-0 mb-3 text-muted font-italic">
                                        Obs.: ao selecionar qualquer um de seus arquivos, uma nova aba será aberta.
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-9">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Palavras-Chaves 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        @foreach (explode(',', $acao_extensao->palavras_chaves) as $palavra_chave)
                                            <span class="">{{$palavra_chave}}</span>,
                                        @endforeach
                                    </small>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class=" p-3 border rounded" style="min-height: 130px">
                                <h2>
                                    Descrição 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->descricao}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                    Público Alvo 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->publico_alvo}}
                                    </small>
                                </h2>
                                <h2>
                                    Estimativa Público:
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->estimativa_publico}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                    Impactos para a Universidade 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->impactos_universidade}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                Impactos para a Sociedade 
                                <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->impactos_sociedade}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>

                    @if(isset($acao_extensao->vagas_curricularizacao))
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                    Vagas Curricularização 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->vagas_curricularizacao}}
                                    </small>
                                </h2>
                                <h2>
                                    Quantidade de horas por Aluno na Curricularização 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->qtd_horas_curricularizacao}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                    Motivo da Curricularização 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->motivo_curricularizacao}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mt-3">
                        @if(isset($acao_extensao->anotacoes) && $acao_extensao->user->id == $user->id)
                        <div class="col-lg-6">
                            <div class=" p-3 border rounded" style="min-height: 145px">
                                <h2>
                                    Suas Anotações 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_extensao->anotacoes}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        @endif
                        @if( ($acao_extensao->user->id == $user->id || request()->user->comissaoExtensao()) && !is_null($acao_extensao->mensagem_extensao)  )
                        <div class="col-lg-6">
                            <div class=" p-3 rounded alert alert-warning" style="min-height: 145px">
                                <h2>
                                    Mensagem para Comissão de Extensão 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 ">
                                        {{$acao_extensao->mensagem_extensao}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-3 mb-5">
                        @if ( !is_null($acao_extensao->parecer_comissao_graduacao) && ($acao_extensao->user->id == $user->id || request()->user->comissaoGraduacao()) )
                        <div class="col-lg-6">
                            <div class=" p-3 rounded border" style="min-height: 145px">
                                <h2>
                                    Parecer Comissão Graduação 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 ">
                                        {{$acao_extensao->parecer_comissao_graduacao}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        @endif
                        @if ( !is_null($acao_extensao->parecer_comite) && ($acao_extensao->user->id == $user->id || $acao_extensao->comite_user_id == $user->id) )
                        <div class="col-lg-6">
                            <div class=" p-3 rounded border" style="min-height: 145px">
                                <h2>
                                    Parecer Comitê 
                                    <!-- <button class="btn btn-primary btn-xs"><i class='fal fa-file-edit'></i> Editar</button> -->
                                    <small class="mt-0 mb-3 ">
                                        {{$acao_extensao->parecer_comite}}
                                    </small>
                                </h2>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card mb-3 shadow">
                            <div class="card-header bg-primary rounded" id="headingTwo">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-landmark icon-stack-1x opacity-100 color-white"></i>
                                    </div>
                                    <div class="ml-3 color-white">
                                        Unidades
                                    </div>
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                            <i class="far fa-chevron-up icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                        <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                            <i class="far fa-chevron-down icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse d-print-block" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if($userCoordenadorAcao && $acao_extensao->status != 'Aprovado')
                                    <div class="panel-tag">
                                        Para inserir/remover unidades envolvidas na ação, é necessário que esta seja <code>aprovada pela comissão</code>.
                                        @if($acao_extensao->status != 'Pendente')
                                        <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="frame-wrap">
                                        <table class="table m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>SIGLA</th>
                                                    <th>Nome Completo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Principal
                                                    </th>
                                                    <th>
                                                        {{$acao_extensao->unidade->sigla}}
                                                    </th>
                                                    <th>
                                                        {{$acao_extensao->unidade->nome}}
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                @foreach($unidades_envolvidas_acao_extensao as $unidade)
                                                <tr>
                                                    <td>
                                                        Envolvida
                                                    </td>
                                                    <td>
                                                        {{$unidade->sigla}}
                                                    </td>
                                                    <td>
                                                        {{$unidade->nome}}
                                                    </td>
                                                    <td>
                                                        @if($userCoordenadorAcao)
                                                        <form method="POST" action="{{ route('acao_extensao.unidade.destroy', $unidade->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                            @csrf
                                                            <input type="hidden" name="acao_extensao_id" value="{{ $acao_extensao->id }}">
                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                        <div class="accordion" id="accordionUnidade">
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseUnidade" aria-expanded="true" aria-controls="collapseUnidade">
                                                        Adicionar Unidade Envolvida com a Ação Extensão
                                                        <span class="ml-auto">
                                                            <span
                                                                class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                                <i
                                                                    class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                                            </span>
                                                            <span
                                                                class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                                <i
                                                                    class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </div>
                                                <div id="collapseUnidade" class="show" aria-labelledby="headingTwo" data-parent="#accordionUnidade">
                                                    <div class="card-body">
                                                        <form action="{{route('acao_extensao.unidades.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_unidades" method="POST">
                                                            @csrf
                                                            <div class="row g-2">
                                                                <div class="form-group col-md-2">

                                                                    <select class="form-control @error('unidade_id') is-invalid @enderror" id="unidade_id" name="unidade_id">
                                                                        <option value="">Selecione a Unidade Envolvida</option>
                                                                        @if (!empty($unidades))
                                                                        @foreach ($unidades as $unidade)
                                                                        <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('unidade_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label class="form-label" hidden></label>
                                                                    <button class="btn btn-primary" type="submit"><span class="fal fa-plus mr-1"></span>Adicionar</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header bg-primary rounded" id="headingOne">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-secondary-400"></i>
                                        <i class="fal fa-calendar-alt icon-stack-1x opacity-100 color-secondary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Datas e Locais de Realização
                                    </div>
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
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if($userCoordenadorAcao && $acao_extensao->status != 'Aprovado')
                                    <div class="panel-tag">
                                        Para inserir/remover datas/locais realizadas na ação, é necessário que esta seja <code>aprovada pela comissão</code>.
                                        @if($acao_extensao->status != 'Pendente')
                                        <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                    @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                    <div class="panel-tag">
                                        @if($userCoordenadorAcao)
                                        <a href="/acoes-extensao/{{$acao_extensao->id}}/ocorrencias"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Gerenciar Ocorrências
                                            </button></a></li>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="frame-wrap">
                                        <table class="table m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Data/Hora Inicio</th>
                                                    <th>Data/Hora Fim</th>
                                                    <th>Local Realização</th>
                                                    <th>Complemento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ocorrencias as $ocorrencia)
                                                <tr>
                                                    <td>
                                                        {{$ocorrencia->data_hora_inicio}}
                                                    </td>
                                                    <td>
                                                        {{$ocorrencia->data_hora_fim}}
                                                    </td>
                                                    <td>
                                                        {{$ocorrencia->local}}
                                                    </td>
                                                    <td>
                                                        {{$ocorrencia->complemento}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card mb-3 shadow">
                            <div class="card-header bg-primary rounded" id="headingThree">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-users icon-stack-1x opacity-100 color-white"></i>
                                    </div>
                                    <div class="ml-3 color-white">
                                        Coordenador e Equipe
                                    </div>
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-up icon-stack-0-5x opacity-100  color-white"></i>
                                        </span>
                                        <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-down icon-stack-0-5x opacity-100  color-white"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    @if($userCoordenadorAcao && $acao_extensao->status != 'Aprovado')
                                    <div class="panel-tag">
                                        Para inserir colaboradores na ação, é necessário que esta seja <code>aprovada pela comissão</code>.
                                        @if($acao_extensao->status != 'Pendente')
                                        <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="frame-wrap">
                                        @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                        <form action="{{route('acao_extensao.grau_equipe', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_grau_equipe" method="POST">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="grau_envolvimento_equipe_id">Tipo de envolvimento da equipe com a Comunidade <span class="text-danger">*</span></label>
                                                    <select class="form-control @error('grau_envolvimento_equipe_id') is-invalid @enderror" id="grau_envolvimento_equipe_id" name="grau_envolvimento_equipe_id">
                                                        @if(isset($acao_extensao->grau_envolvimento_equipe))
                                                            <option value="{{$acao_extensao->grau_envolvimento_equipe->id}}">{{$acao_extensao->grau_envolvimento_equipe->descricao}}</option>
                                                        @else
                                                            <option value="">Selecione o Tipo</option>
                                                        @endif
                                                            <option value="">Selecione o tipo do envolvimento</option>
                                                        @if (!empty($graus_envolvimento_equipe))
                                                        @foreach ($graus_envolvimento_equipe as $grau_envolvimento_equipe)
                                                            <option value="{{$grau_envolvimento_equipe->id}}">{{$grau_envolvimento_equipe->descricao}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('grau_envolvimento_equipe_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="form-group mt-3 ml-3">
                                                        <button class="btn btn-primary" type="submit"><span class="icon text-white-50">
                                                                <i class="fal fa-save"></i>
                                                            </span>
                                                            <span class="text">Salvar</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="panel-tag">
                                            @if($userCoordenadorAcao)
                                                Para gerenciar a equipe e adicionar membros, é necessário haver uma ocorrência. <a href="/acoes-extensao/{{$acao_extensao->id}}/ocorrencias"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Gerenciar Ocorrências
                                                </button></a></li>
                                            @endif
                                        </div>
                                        @endif
                                        <table class="table m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Nome Completo</th>
                                                    <th>Email</th>
                                                    <th>Documento</th>
                                                    <th>Nº Documento</th>
                                                    <th>Vinculo</th>
                                                    <th>Carga Horaria</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>{{$acao_extensao->nome_coordenador}}</th>
                                                    <th>{{$acao_extensao->email_coordenador}}</th>
                                                    <th>(Coordenador Ação)</th>
                                                    <th>N/A</th>
                                                    <th>{{$acao_extensao->vinculo_coordenador}}</th>
                                                    <th>N/A</th>
                                                    <th>-</th>
                                                </tr>
                                                @foreach ($colaboradores_acao_extensao as $colaborador)
                                                <tr>
                                                    <td>
                                                        {{$colaborador->nome}}
                                                    </td>
                                                    <td>
                                                        {{$colaborador->email}}
                                                    </td>
                                                    <td>
                                                        {{$colaborador->documento}}
                                                    </td>
                                                    <td>
                                                        {{$colaborador->numero_doc}}
                                                    </td>
                                                    <td>
                                                        {{$colaborador->vinculo}}
                                                    </td>
                                                    <td>
                                                        {{$colaborador->carga_horaria}}
                                                    </td>
                                                    <td>
                                                        @if($userCoordenadorAcao)
                                                        <form method="POST" action="{{ route('acao_extensao.colaborador.destroy', $colaborador->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                            @csrf
                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header" id="headingFour">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                        <i class="fal fa-building icon-stack-1x opacity-100 color-info-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Parceiros
                                    </div>
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
                                    @if($userCoordenadorAcao && $acao_extensao->status != 'Aprovado')
                                    <div class="panel-tag">
                                        Para inserir/remover parcerias envolvidas na ação, é necessário que esta seja <code>aprovada pela comissão</code>.
                                        @if($acao_extensao->status != 'Pendente')
                                            <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
                                        </form>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="frame-wrap">
                                        <table class="table m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Parceiro</th>
                                                    <th>Tipo</th>
                                                    <th>Colaboracao</th>
                                                    <th>Data/hora Adicionado em:</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($parceiros_acao_extensao as $parceiro)
                                                <tr>
                                                    <td>
                                                        {{$parceiro->nome}}
                                                    </td>
                                                    <td>
                                                        {{$parceiro->tipo_parceiro->descricao}}
                                                    </td>
                                                    <td>
                                                        {{$parceiro->colaboracao}}
                                                    </td>
                                                    <td>
                                                        {{$parceiro->created_at->format('d/m/Y')}}
                                                    </td>
                                                    <td>
                                                        @if($userCoordenadorAcao)
                                                        <form method="POST" action="{{ route('acao_extensao.parceiro.destroy', $parceiro->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                            @csrf
                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                        <div class="accordion" id="accordionParceiro">
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseParceiro" aria-expanded="true" aria-controls="collapseParceiro">
                                                        Adicionar Parceiro na Ação de Extensão
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
                                                <div id="collapseParceiro" class="show" aria-labelledby="headingTwo" data-parent="#accordionParceiro">
                                                    <div class="card-body">
                                                        <form action="{{route('acao_extensao.parceiro.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_local" method="POST">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="form-group col-md-4">
                                                                    <label class="form-label" for="nome">Nome<span class="text-danger">*</span></label>
                                                                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
                                                                    @error('nome')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label class="form-label" for="tipo_parceiro_id">Tipo <span class="text-danger">*</span></label>
                                                                    <select class="form-control @error('tipo_parceiro_id') is-invalid @enderror" id="tipo_parceiro_id" name="tipo_parceiro_id">
                                                                        <option value="">Selecione o Tipo</option>
                                                                        @if (!empty($lista_tipos))
                                                                        @foreach ($lista_tipos as $tipo)
                                                                        <option value="{{$tipo->id}}" @if( old('tipo_parceiro_id') == $tipo->id ) selected @endif>{{$tipo->descricao}}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('tipo_parceiro_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-8">
                                                                    <label class="form-label" for="colaboracao">Colaboracao <span class="text-danger">*</span></label>
                                                                    <textarea id="colaboracao" name="colaboracao" class="form-control @error('colaboracao') is-invalid @enderror" rows="2">{{ old('colaboracao') }}</textarea>
                                                                    @error('colaboracao')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-md-4">

                                                                    <button class="btn btn-primary" type="submit"><span class="fal fa-plus mr-1"></span>Adicionar</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card mb-3 shadow">
                            <div class="card-header bg-primary rounded" id="headingFive">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-map-marker-alt icon-stack-1x opacity-100 color-success-500 color-white"></i>
                                    </div>
                                    <div class="ml-3 color-white">
                                        Cidade e Georreferenciação
                                    </div>
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-up icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                        <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-down icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="frame-wrap">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <a href="/acoes-extensao/cidades/{{$acao_extensao->municipio->id}}">
                                                        <i class="fal fa-map-marker-alt"></i> {{$acao_extensao->municipio->nome_municipio}} - {{$acao_extensao->municipio->estado}}
                                                    </a>
                                                    <small>
                                                        Cidade - Estado
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="pb-3 pt-2 border-top-0 border-left-0 border-right-0 text-muted">
                                            <x-maps-leaflet
                                                :centerPoint="['lat' => -22.195240, 'long' => -48.433408]"
                                                :zoomLevel="7"
                                                :markers="[['lat' => $acao_extensao->municipio->latitude, 'long' => $acao_extensao->municipio->longitude, 'info' => 'teste', 'icon' => 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|1ABB9C|000000'], ['lat' => '-22.818177', 'long' => '-47.064098', 'info' => 'UNICAMP'] ]">
                                            </x-maps-leaflet>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header bg-primary rounded" id="headingArquivo">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseArquivo" aria-expanded="false" aria-controls="collapseArquivo">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="far fa-file icon-stack-1x opacity-100 color-white"></i>
                                    </div>
                                    <div class="ml-3 color-white">
                                        Arquivos
                                    </div>
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-up icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                        <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                            <i class="fal fa-chevron-down icon-stack-0-5x opacity-100 color-white"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseArquivo" class="collapse" aria-labelledby="headingArquivo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="col-6">
                                        @if($userCoordenadorAcao)
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
                                            <input type="hidden" name="modulo" value="acoes-extensao">
                                            <input type="hidden" name="referencia_id" value="{{ $acao_extensao->id }}">
                                            <button class="btn btn-success mt-3">Enviar</button>
                                        </form>
                                        @endif

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
                                                    <a href='{{ url("storage/$arquivo->url_arquivo") }}' class="btn btn-xs btn-warning waves-effect waves-themed mb-1" href="#" target="_blank">Abrir Arquivo</a>
                                                    @if($userCoordenadorAcao)
                                                    <form action='{{ url("upload-arquivo/" . $arquivo->id) }}' method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                    </form>
                                                    @endif
                                                </h5>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group my-5 mx-3">
                            @if($userCoordenadorAcao && $acao_extensao->status == 'Rascunho')
                            <form action="{{ url('acoes-extensao/'. $acao_extensao->id .'/submeter') }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary ">
                                    <span class="icon text-white-50">
                                    <img src="{{ asset('smartadmin-4.5.1/img/icone_aprova.png') }}" alt="Apreciação">
                                    </span>
                                    <span class="text">Enviar para apreciação</span>
                                </button>
                                <a href="{{ url('acoes-extensao/'.$acao_extensao->id.'/editar') }}" class="btn btn-primary">
                                    <i class="far fa-edit color-white"></i>
                                    <span class="text">Editar</span>
                                </a>
                            </form>
                            
                            @endif
                        </div>
                    </div>
                    <div class="panel-footer border-top border-secondary">
                        <div class="row my-5">
                            <div class="col-md-12">
                                <a href="{{ url('acoes-extensao') }}" class="btn btn-primary">
                                    <span class="icon text-white-50">
                                        <img src="{{ asset('smartadmin-4.5.1/img/381.png') }}" alt="Apreciação">
                                    </span>
                                    <span class="text">Minhas Ações de Extensão</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if( $userNaComissao || $userCoordenadorAcao && ($acao_extensao->status != "Rascunho") )
<div class="row">
    <div class="col-xl-12">
        @foreach ($acao_extensao->comentarios as $comentario)
        <div class="card mb-g border shadow-0">
            <div class="card-header p-0">
                <div class="p-3 d-flex flex-row">
                    <div class="d-block flex-shrink-0">
                        <img src="{{asset('smartadmin-4.5.1/img/demo/avatars/avatar-m.png')}}" class="img-fluid img-thumbnail" alt="{{$acao_extensao->nome_coordenador}}">
                    </div>
                    <div class="d-block ml-2">
                        <span class="h6 font-weight-bold text-uppercase d-block m-0">COMENTÁRIO</span>
                        <a href="javascript:void(0);" class="fs-sm text-info h6 fw-500 mb-0 d-block">{{ $comentario->user->name }}</a>
                        <div class="d-flex mt-1 text-warning align-items-center">
                            <i class="fal fa-landmark mr-1"></i>
                            <span class="text-muted fs-xs font-italic">
                                {{$comentario->user->unidade->nome}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <p>
                    {{ $comentario->comentario }}
                </p>
            </div>
            <div class="card-footer">
                <div class="d-flex align-items-center">
                    <span class="text-sm text-muted font-italic"><i class="fal fa-clock mr-1"></i> Comentário feito em: {{$comentario->created_at->format('d/m/Y')}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Adicionar Comentário
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('acao_extensao.comentar', ['acao_extensao' => $acao_extensao->id]) }}" id="form_acao_extensao_comentario" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="comentario">Comentário <span class="text-danger">*</span></label>
                                <textarea id="comentario" name="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="5">{{ old('comentario') }}</textarea>
                                @error('comentario')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-w-m fw-500 btn-sm">Enviar Comentario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
