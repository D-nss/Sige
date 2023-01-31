@extends('layouts.app')

@section('title', 'Exibição da Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao"> Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Detalhes da Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao/{{$acao_extensao->id}}/editar"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Editar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
@if($acao_extensao->status == 'Rascunho')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação de Extensão cadastrada, porém não submetida para aprovação</span>
        </div>
        @if($userCoordenadorAcao)
        <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
        </form>
        @endif

        <!--a href="/acoes-extensao/{{$acao_extensao->id}}/aprovar" class="btn btn-warning btn-w-m fw-500 btn-sm"  aria-label="Close">Aprovar</a-->
    </div>
</div>
@endif
@if($acao_extensao->status == 'Pendente')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação de Extensão foi Submetida, e pendende de aprovação pela Unidade</span>
        </div>
        @if($userNaComissao)
        <form action="{{ route('acao_extensao.aprovar', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Aprovar</button>
        </form>
        @endif
        <!--a href="/acoes-extensao/{{$acao_extensao->id}}/aprovar" class="btn btn-warning btn-w-m fw-500 btn-sm"  aria-label="Close">Aprovar</a-->
    </div>
</div>
@endif
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> {{$acao_extensao->titulo}}
        @switch($acao_extensao->status)
                                        @case('Desativado')
                                        <span class="badge badge-danger">Desativado</span>
                                            @break
                                        @case('Pendente')
                                            <span class="badge badge-warning">Pendente</span>
                                            @break
                                        @case('Rascunho')
                                            <span class="badge badge-warning">Rascunho</span>
                                            @break
                                        @case('Aprovado')
                                            <span class="badge badge-success">Aprovado</span>
                                            @break
                                        @default
                                        <span class="badge badge-warning">Indefinido</span>
        @endswitch
        <small>
            Exibição das informações desta Ação de Extensão. <span class="text-muted small text-truncate"> (<strong> Cadastrado em:</strong> {{$acao_extensao->created_at->format('d/m/Y')}}. <strong> Atualizado em: </strong> {{$acao_extensao->updated_at->format('d/m/Y')}})</span>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
      <div id="panel-3" class="panel">
          <div class="panel-container show">
              <div class="panel-content">

                    <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            @switch($acao_extensao->modalidade)
                                    @case(1)
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                            <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                            Programa
                                        @break
                                    @case(2)
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                                <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                                            </div>
                                            <div class="ml-3">
                                            <h5 class="mb-0 flex-1 text-dark fw-500">
                                        Projeto
                                        @break
                                    @case(3)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                            <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                        Curso
                                        @break
                                    @case(4)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                            <i class="fal fa-newspaper icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                        Evento
                                        @break
                                    @case(5)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-success-500"></i>
                                            <i class="fal fa-inbox icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                        Prestação de Serviços
                                        @break
                                    @default
                            @endswitch
                            <small class="m-0 l-h-n">
                                <b>Linha:</b> {{$acao_extensao->linha_extensao->nome}}
                            </small>
                        </h5>
                        <div>
                            @foreach ($acao_extensao->areas_tematicas as $area_tematica)
                                <a href="/acoes-extensao/areas/{{$area_tematica->id}}"><span class="badge badge-success">{{$area_tematica->nome}}</span></a>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                Objetivos de Desenvolvimento Sustentável:
                                <small class="mt-0 mb-3 text-muted">
                                    @foreach ($acao_extensao->objetivos_desenvolvimento_sustentavel as $ods)
                                        <a href="#"><span class="badge badge-danger">{{$ods->nome}}</span></a>
                                    @endforeach
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                              Descrição:
                              <small class="mt-0 mb-3 text-muted">
                                  {{$acao_extensao->descricao}}
                              </small>
                            </h5>
                        </div>
                    </div>
                    @if($acao_extensao->palavras_chaves != "")
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                                Palavras-chaves:
                                <small class="mt-0 mb-3 text-muted">
                                    @foreach (explode(',', $acao_extensao->palavras_chaves) as $palavra_chave)
                                        <a href="/acoes-extensao/palavra-chave/{{$palavra_chave}}"><span class="badge badge-secondary">{{$palavra_chave}}</span></a>
                                    @endforeach
                                </small>
                            </h5>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                              Público Alvo:
                              <small class="mt-0 mb-3 text-muted">
                                  {{$acao_extensao->publico_alvo}}
                              </small>
                            </h5>
                        </div>
                    </div>
                    @if(isset($acao_extensao->vagas_curricularizacao))
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                            Vagas Curricularização:
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->vagas_curricularizacao}}
                            </small>
                            </h5>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                      <div class="p-0">
                          <h5>
                              Impactos para a Universidade:
                              <small class="mt-0 mb-3 text-muted">
                                  {{$acao_extensao->impactos_universidade}}
                              </small>
                          </h5>
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="p-0">
                          <h5>
                              Impactos para a Sociedade:
                              <small class="mt-0 mb-3 text-muted">
                                  {{$acao_extensao->impactos_sociedade}}
                              </small>
                          </h5>
                      </div>
                  </div>
                  @if(isset($acao_extensao->grau_envolvimento_equipe))
                  <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Envolvimento da Equipe com a Comunidade:
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->grau_envolvimento_equipe->descricao}}
                            </small>
                        </h5>
                    </div>
                  </div>
                  @endif
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                              Link Externo:
                              <small class="mt-0 mb-3 text-muted">
                                  <a href="{{$acao_extensao->url}}" target="_blank" >{{$acao_extensao->url}}</a>
                              </small>
                            </h5>
                        </div>
                    </div>
                      <div class="accordion" id="accordionExample">
                          <div class="card">
                              <div class="card-header" id="headingTwo">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                                        <i class="fal fa-landmark icon-stack-1x opacity-100 color-warning-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Unidade
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
                                                            <span class="collapsed-reveal">
                                                                <i class="fal fa-minus-circle text-danger"></i>
                                                            </span>
                                                            <span class="collapsed-hidden">
                                                                <i class="fal fa-plus-circle text-success"></i>
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
                          <div class="card">
                            <div class="card-header" id="headingOne">
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
                                  <div class="frame-wrap">
                                      <table class="table m-0">
                                          <thead class="thead-themed">
                                              <tr>
                                                  <th>Local Realização</th>
                                                  <th>Data/Hora Inicio</th>
                                                  <th>Data/Hora Fim</th>
                                                  <th>Complemento</th>
                                                  <th>Latitude</th>
                                                  <th>Longitude</th>
                                                  <th>Adicionado em:</th>
                                                  <th>Remoção</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($datas_locais_acao_extensao as $data_local)


                                              <tr>
                                                  <td>
                                                    {{$data_local->local}}
                                                  </td>
                                                  <td>
                                                    {{$data_local->data_hora_inicio}}
                                                  </td>
                                                  <td>
                                                    {{$data_local->data_hora_fim}}
                                                  </td>
                                                  <td>
                                                      {{$data_local->complemento}}
                                                  </td>
                                                  <td>
                                                    {{$data_local->latitude}}
                                                </td>
                                                <td>
                                                    {{$data_local->longitude}}
                                                </td>
                                                <td>
                                                    {{$data_local->created_at->format('d/m/Y')}}
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('acao_extensao.local.destroy', $data_local->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                        @csrf
                                                        <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                     </form>
                                                </td>
                                                </tr>
                                                @endforeach
                                          </tbody>
                                      </table>
                                      @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                      <div class="accordion" id="accordionLocal">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseLocal" aria-expanded="true" aria-controls="collapseLocal">
                                                    Adicionar Data e Local de Realização da Ação de Extensão
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
                                            <div id="collapseLocal" class="show" aria-labelledby="headingTwo" data-parent="#accordionLocal">
                                                <div class="card-body">
                                                    <form action="{{route('acao_extensao.data_local.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_data_local" method="POST">
                                                        @csrf
                                                        <div class="row g-5">
                                                            <div class="form-group col-md-2">
                                                                <label class="form-label" for="data_hora_inicio">Data Hora Inicio<span class="text-danger">*</span></label>
                                                                <input class="form-control @error('data_hora_inicio') is-invalid @enderror" type="datetime-local" id="data_hora_inicio" name="data_hora_inicio" placeholder="dd/mm/aaaa" value="">
                                                                @error('data_hora_inicio')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label class="form-label" for="data_hora_fim">Data Hora Fim</label>
                                                                <input class="form-control @error('data_hora_fim') is-invalid @enderror" type="datetime-local" id="data_hora_fim" name="data_hora_fim" placeholder="dd/mm/aaaa" value="">
                                                                @error('data_hora_fim')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="form-label" for="local">Local<span class="text-danger">*</span></label>
                                                                <input type="text" id="local" name="local" class="form-control @error('local') is-invalid @enderror">
                                                                @error('local')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label class="form-label" for="latitude">Latitude </label>
                                                                <input type="number" id="latitude" name="latitude" class="form-control @error('latitude') is-invalid @enderror">
                                                                @error('latitude')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label class="form-label" for="longitude">Longitude </label>
                                                                <input type="number" id="longitude" name="longitude" class="form-control @error('longitude') is-invalid @enderror">
                                                                @error('longitude')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="form-group col-md-10">
                                                                <label class="form-label" for="complemento">Complemento</label>
                                                                <textarea id="complemento" name="complemento" class="form-control @error('complemento') is-invalid @enderror" rows="2"></textarea>
                                                                @error('complemento')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-2">

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
                          <div class="card">
                              <div class="card-header" id="headingThree">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Coordenador e Equipe
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
                                              </tr>
                                              @endforeach
                                          </tbody>
                                      </table>
                                      @if($userCoordenadorAcao && $acao_extensao->status == 'Aprovado')
                                      <div class="accordion" id="accordionColaborador">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseColaborador" aria-expanded="true" aria-controls="collapseColaborador">
                                                    Adicionar Colaborador com a Ação Extensão
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
                                            <div id="collapseColaborador" class="show" aria-labelledby="headingTwo" data-parent="#accordionColaborador">
                                                <div class="card-body">
                                                    <form action="{{route('acao_extensao.colaborador.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_equipe" method="POST">
                                                        @csrf
                                                        <div class="row g-4">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="nome">Nome do Colaborador(a) <span class="text-danger">*</span></label>
                                                                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror">
                                                                @error('nome')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                                                @error('email')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="documento">Documento <span class="text-danger">*</span></label>
                                                                <select class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento">
                                                                    <option value="">Selecione o Documento</option>
                                                                    @if (!empty($lista_documento))
                                                                        @foreach ($lista_documento as $documento_colaborador)
                                                                          <option value="{{$documento_colaborador}}">{{$documento_colaborador}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @error('documento')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="numero_doc">Número Documento<span class="text-danger">*</span></label>
                                                                <input type="number" id="numero_doc" name="numero_doc" class="form-control @error('numero_doc') is-invalid @enderror">
                                                                @error('numero_doc')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="carga_horaria">Carga Horária<span class="text-danger">*</span></label>
                                                                <input type="number" id="carga_horaria" name="carga_horaria" class="form-control @error('carga_horaria') is-invalid @enderror">
                                                                @error('carga_horaria')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                          <div class="form-group col-md-3">
                                                              <label class="form-label" for="vinculo">Vinculo <span class="text-danger">*</span></label>
                                                              <select class="form-control @error('vinculo') is-invalid @enderror" id="vinculo" name="vinculo">
                                                                  <option value="">Selecione o Vinculo</option>
                                                                  @if (!empty($lista_vinculo))
                                                                      @foreach ($lista_vinculo as $vinculo_colaborador)
                                                                        <option value="{{$vinculo_colaborador}}">{{$vinculo_colaborador}}</option>
                                                                      @endforeach
                                                                  @endif
                                                              </select>
                                                              @error('vinculo')
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
                          <div class="card">
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
                                                        <form method="POST" action="{{ route('acao_extensao.parceiro.destroy', $parceiro->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                            @csrf
                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                         </form>
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
                                                            <span class="collapsed-reveal">
                                                                <i class="fal fa-minus-circle text-danger"></i>
                                                            </span>
                                                            <span class="collapsed-hidden">
                                                                <i class="fal fa-plus-circle text-success"></i>
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
                                                                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror">
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
                                                                              <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
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
                                                                    <textarea id="colaboracao" name="colaboracao" class="form-control @error('colaboracao') is-invalid @enderror" rows="2"></textarea>
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
                          </div>
                          <div class="card">
                              <div class="card-header" id="headingFive">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                        <i class="fal fa-map-marked-alt icon-stack-1x opacity-100 color-success-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Cidade e Georreferenciação
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
                      </div>

              </div>
          </div>
      </div>
    </div>
  </div>

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
                            <textarea id="comentario" name="comentario" class="form-control @error('comentario') is-invalid @enderror" rows="5"></textarea>
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

@endsection
