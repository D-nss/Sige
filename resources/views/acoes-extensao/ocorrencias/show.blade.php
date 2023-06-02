@extends('layouts.app')

@section('title', 'Exibição da Ocorrência')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao"> Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Detalhes da Ocorrência</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao/ocorrencias/{{$acaoExtensaoOcorrencia->id}}/editar"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Editar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> {{$acaoExtensaoOcorrencia->acao_extensao->titulo}}
        <small>
            Exibição dos detalhes da Ocorrência. <span class="text-muted small text-truncate"> (<strong> Cadastrado em:</strong> {{$acaoExtensaoOcorrencia->created_at->format('d/m/Y')}}. <strong> Atualizado em: </strong> {{$acaoExtensaoOcorrencia->updated_at->format('d/m/Y')}})</span>
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
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-secondary-400"></i>
                                            <i class="fal fa-calendar-alt icon-stack-1x opacity-100 color-secondary-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                            Período:
                            <small class="m-0 l-h-n">
                                <b>Inicio:</b> {{$acaoExtensaoOcorrencia->data_hora_inicio->format('d/m/Y - H:i')}}. <b>Final:</b> {{$acaoExtensaoOcorrencia->data_hora_fim->format('d/m/Y - H:i')}}
                            </small>
                        </h5>

                        </div>
                    </div>
                    <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                            <i class="fal fa-map-marked-alt icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                            Local:
                            <small class="m-0 l-h-n">
                                <b>Nome:</b> {{$acaoExtensaoOcorrencia->local}}.
                                @if(isset($acaoExtensaoOcorrencia->latitude)) <b>Latitude:</b> {{$acaoExtensaoOcorrencia->latitude}}. @endif
                                @if(isset($acaoExtensaoOcorrencia->longitude)) <b>Longitude:</b> {{$acaoExtensaoOcorrencia->longitude}}. @endif
                            </small>
                        </h5>

                        </div>
                    </div>
                    @if(isset($acaoExtensaoOcorrencia->complemento))
                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                                            <div class='icon-stack display-3 flex-shrink-0'>
                                                <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                                <i class="fal fa-info icon-stack-1x opacity-100 color-danger-500"></i>
                                            </div>
                                            <div class="ml-3">
                                            <h5 class="mb-0 flex-1 text-dark fw-500">
                                                Complemento:
                                <small class="m-0 l-h-n">
                                    {{$acaoExtensaoOcorrencia->complemento}}.
                                </small>
                            </h5>

                            </div>
                        </div>
                    @endif
                    @if(isset($acaoExtensaoOcorrencia->acao_extensao->vagas_curricularizacao))
                    <div class="col-12">
                        <div class="p-0">
                            <h5>
                            Vagas Curricularização:
                            <small class="mt-0 mb-3 text-muted">
                                {{$acaoExtensaoOcorrencia->acao_extensao->vagas_curricularizacao}}
                            </small>
                            </h5>
                        </div>
                    </div>
                    @endif


                      <div class="accordion" id="accordionExample">
                          <div class="card">
                              <div class="card-header" id="headingThree">
                                  <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        Equipe
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
                                    @if($acaoExtensaoOcorrencia->acao_extensao->status != 'Aprovado')
                                    <div class="panel-tag">
                                        Para inserir colaboradores na ação, é necessário que esta seja <code>aprovada pela comissão</code>.
                                        @if($acaoExtensaoOcorrencia->acao_extensao->status != 'Pendente')
                                            <form action="{{ route('acao_extensao.submeter', ['acao_extensao' => $acaoExtensaoOcorrencia->acao_extensao->id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Enviar para Aprovação</button>
                                            </form>
                                            @endif
                                    </div>
                                    @endif
                                    <div class="frame-wrap">
                                        @if($acaoExtensaoOcorrencia->acao_extensao->status == 'Aprovado')
                                        <form action="{{route('acao_extensao.grau_equipe', ['acao_extensao_id' => $acaoExtensaoOcorrencia->acao_extensao->id])}}" id="form_grau_equipe" method="POST">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label" for="grau_envolvimento_equipe_id">Tipo de envolvimento da equipe com a Comunidade <span class="text-danger">*</span></label>
                                                    <select class="form-control @error('grau_envolvimento_equipe_id') is-invalid @enderror" id="grau_envolvimento_equipe_id" name="grau_envolvimento_equipe_id">
                                                        @if(isset($acaoExtensaoOcorrencia->acao_extensao->grau_envolvimento_equipe))
                                                            <option value="{{$acaoExtensaoOcorrencia->acao_extensao->grau_envolvimento_equipe->id}}">{{$acaoExtensaoOcorrencia->acao_extensao->grau_envolvimento_equipe->descricao}}</option>
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
                                                  <th></th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <th>{{$acaoExtensaoOcorrencia->acao_extensao->nome_coordenador}}</th>
                                                <th>{{$acaoExtensaoOcorrencia->acao_extensao->email_coordenador}}</th>
                                                <th>(Coordenador Ação)</th>
                                                <th>N/A</th>
                                                <th>{{$acaoExtensaoOcorrencia->acao_extensao->vinculo_coordenador}}</th>
                                                <th>N/A</th>
                                                <th>-</th>
                                            </tr>
                                              @foreach ($colaboradores_ocorrencia as $colaborador)
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
                                      @if($userCoordenadorAcao && $acaoExtensaoOcorrencia->acao_extensao->status == 'Aprovado')
                                      <div class="accordion" id="accordionColaborador">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseColaborador" aria-expanded="true" aria-controls="collapseColaborador">
                                                    Adicionar Colaborador na Ocorrência
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
                                                    <form action="{{route('acao_extensao.colaborador.inserir', ['acao_extensao_id' => $acaoExtensaoOcorrencia->acao_extensao->id])}}" id="form_acao_extensao_equipe" method="POST">
                                                        @csrf
                                                        <div class="row g-4">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="nome">Nome do Colaborador(a) <span class="text-danger">*</span></label>
                                                                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
                                                                @error('nome')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
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
                                                                          <option value="{{$documento_colaborador}}" @if( old('documento') == $documento_colaborador ) selected @endif>{{$documento_colaborador}}</option>
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
                                                                <input type="number" id="numero_doc" name="numero_doc" class="form-control @error('numero_doc') is-invalid @enderror" value="{{ old('numero_doc') }}">
                                                                @error('numero_doc')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label" for="carga_horaria">Carga Horária<span class="text-danger">*</span></label>
                                                                <input type="number" id="carga_horaria" name="carga_horaria" class="form-control @error('carga_horaria') is-invalid @enderror" value="{{ old('carga_horaria') }}">
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
                                                                        <option value="{{$vinculo_colaborador}}" @if( old('vinculo') == $vinculo_colaborador ) selected @endif>{{$vinculo_colaborador}}</option>
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
                            <div class="card-header" id="headingThree">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  <div class='icon-stack display-3 flex-shrink-0'>
                                      <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                      <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                  </div>
                                  <div class="ml-3">
                                      Curricularização
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
                                    <table class="table m-0">
                                        <thead class="thead-themed">
                                            <tr>
                                                <th>Nome Completo</th>
                                                <th>Email</th>
                                                <th>RA</th>
                                                <th>Carga Horaria</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colaboradores_ocorrencia as $colaborador)
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
                                                      {{$colaborador->carga_horaria}}
                                                  </td>
                                                  <td>
                                                  @if($userCoordenadorAcao)
                                                        <form method="POST" action="{{ route('acao_extensao.colaborador.destroy', $colaborador->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                            @csrf
                                                            <button class="btn btn-xs btn-success waves-effect waves-themed" type="submit">Aprovar</button>
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
                      </div>
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection
