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
@if($acao_extensao->status == 'Pendente')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação de Extensão pendende de aprovação pela Unidade</span>
        </div>
        @hasanyrole('super|admin', 'web_user')
        <form action="{{ route('acao_extensao.aprovar', ['acao_extensao' => $acao_extensao->id]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Aprovar</button>
        </form>
        @endhasanyrole
        <!--a href="/acoes-extensao/{{$acao_extensao->id}}/aprovar" class="btn btn-warning btn-w-m fw-500 btn-sm"  aria-label="Close">Aprovar</a-->
    </div>
</div>
@endif
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> {{$acao_extensao->titulo}}
        @switch($acao_extensao->status)
                                        @case(1)
                                        <span class="badge badge-danger">Desativado</span>
                                            @break
                                        @case(2)
                                            <span class="badge badge-info">Em Andamento</span>
                                            @break
                                        @case(3)
                                            <span class="badge badge-success">Concluído</span>
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
                            Investimento:
                            <small class="mt-0 mb-3 text-muted">
                                R$ {{$acao_extensao->investimento}}
                            </small>
                        </h5>
                    </div>
                </div>
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
                                    <div class="frame-wrap">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Data inicial:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_extensao->data_inicio->format('d/m/Y')}}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Data final:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        @if(isset($acao_extensao->data_fim))
                                                          {{$acao_extensao->data_fim->format('d/m/Y')}}
                                                        @else
                                                            Sem informações
                                                        @endif
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <table class="table m-0">
                                            <thead class="thead-themed">
                                                <tr>
                                                    <th>Local Realização</th>
                                                    <th>Complemento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                      Informação Local
                                                    </td>
                                                    <td>
                                                      Informação Complemento
                                                    </td>
                                                  </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card">
                              <div class="card-header" id="headingTwo">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                                        <i class="fal fa-landmark icon-stack-1x opacity-100 color-warning-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Coordenador e Unidades
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
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Coordenador:
                                                <small class="mt-0 mb-3 text-muted">
                                                    {{$acao_extensao->nome_coordenador}}
                                                </small>

                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Email:
                                                <small class="mt-0 mb-3 text-muted">
                                                    emaildocoordenador
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Vínculo com a Universidade:
                                                <small class="mt-0 mb-3 text-muted">
                                                      {{$acao_extensao->vinculo_coordenador}}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
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
                                                    <td>
                                                        Principal
                                                    </td>
                                                    <td>
                                                        {{$acao_extensao->unidade->sigla}}
                                                    </td>
                                                    <td>
                                                        {{$acao_extensao->unidade->nome}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          @if($acao_extensao->equipe != "")
                          <div class="card">
                              <div class="card-header" id="headingThree">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Colaboradores (Equipe)
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
                                    <div class="frame-wrap">
                                        @if(isset($acao_extensao->qtd_graduacao))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                    Quantidade Graduação:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_extensao->qtd_graduacao}}
                                                    </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($acao_extensao->qtd_pos_graduacao))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                    Quantidade Pós-Graduação:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_extensao->qtd_pos_graduacao}}
                                                    </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($acao_extensao->grau_envolvimento_equipe))
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                Envolvimento com a Comunidade:
                                                <small class="mt-0 mb-3 text-muted">
                                                    {{$acao_extensao->grau_envolvimento_equipe->descricao}}
                                                </small>
                                                </h5>
                                            </div>
                                        </div>
                                        @endif
                                      <table class="table m-0">
                                          <thead class="thead-themed">
                                              <tr>
                                                  <th>Nome Completo</th>
                                                  <th>Email</th>
                                                  <th>CPF</th>
                                                  <th>Vinculo</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              @foreach (explode(',',$acao_extensao->equipe) as $colaborador)
                                              <tr>
                                                  <td>
                                                      {{$colaborador}}
                                                  </td>
                                                  <td>
                                                      email
                                                  </td>
                                                  <td>
                                                      cpf
                                                  </td>
                                                  <td>
                                                      vinculo
                                                  </td>
                                              </tr>
                                              @endforeach
                                          </tbody>
                                      </table>
                                  </div>
                                  </div>
                              </div>
                          </div>
                          @endif
                          @if(isset($acao_extensao->parceiro))
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
                                    <div class="frame-wrap">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Tipo do principal Parceiro:
                                                <small class="mt-0 mb-3 text-muted">
                                                    {{$acao_extensao->tipo_parceiro->descricao}}
                                                </small>
                                                </h5>
                                            </div>
                                        </div>
                                          <table class="table m-0">
                                              <thead class="thead-themed">
                                                  <tr>
                                                      <th>Nome</th>
                                                      <th>Tipo</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach (explode(',',$acao_extensao->parceiro) as $parceiro)
                                                  <tr>
                                                      <td>
                                                          {{$parceiro}}
                                                      </td>
                                                      <td>
                                                          tipo
                                                      </td>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endif
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
