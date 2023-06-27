@extends('layouts.app')

@section('title', 'Exibição da Ocorrência')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao"> Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Detalhes da Ocorrência</li>
    <li class="breadcrumb-item">
    @if(isset($user) && $user->id == $acaoExtensaoOcorrencia->acao_extensao->user_id)
        <a href="/acoes-extensao/ocorrencias/{{$acaoExtensaoOcorrencia->id}}/editar">
            <button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">
                Editar
            </button>
        </a>
    @endif
    </li>
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
                            <h5 class="mb-0 flex-1 align-items-center text-dark fw-500">
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
                    @if(isset($user) && $user->id == $acaoExtensaoOcorrencia->acao_extensao->user_id)
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingEquipe">
                                <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseEquipe" aria-expanded="false" aria-controls="collapseEquipe">
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
                            <div id="collapseEquipe" class="collapse" aria-labelledby="headingEquipe" data-parent="#accordionExample">
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
                                    
                                    <table class="table m-0">
                                        <thead class="thead-themed">
                                            <tr>
                                                <th>Nome Completo</th>
                                                <th>Email</th>
                                                <th>Nº Documento</th>
                                                <th>Vinculo</th>
                                                <th>Função</th>
                                                <th>Carga Horaria</th>
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
                                        </tr>
                                            @foreach ($acaoExtensaoOcorrencia->equipe as $equipe)
                                            <tr>
                                                <td>
                                                    {{$equipe->nome}}
                                                </td>
                                                <td>
                                                    {{$equipe->email}}
                                                </td>
                                                <td>
                                                    {{$equipe->cpf}}
                                                </td>
                                                <td>
                                                    {{$equipe->vinculo}}
                                                </td>
                                                <td>
                                                    {{$equipe->funcao}}
                                                </td>
                                                <td>
                                                    {{$equipe->carga_horaria}}
                                                </td>
                                               
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($acaoExtensaoOcorrencia->acao_extensao->vagas_curricularizacao))
                        <div class="card">
                        <div class="card-header" id="headingCurricularizacao">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseCurricularizacao" aria-expanded="false" aria-controls="collapseCurricularizacao">
                                <div class='icon-stack display-3 flex-shrink-0'>
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                    <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                </div>

                                <div class="ml-3">
                                    <h5 class="mb-0 flex-1 align-items-center text-dark fw-500">
                                        Curricularização:
                                        <small class="m-0 l-h-n">
                                            <b>Vagas:</b> {{$acaoExtensaoOcorrencia->acao_extensao->vagas_curricularizacao}}. <b>Quantidade de Horas por Aluno:</b> {{$acaoExtensaoOcorrencia->acao_extensao->qtd_horas_curricularizacao}}
                                        </small>
                                    </h5>
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
                        <div id="collapseCurricularizacao" class="collapse" aria-labelledby="headingCurricularizacao" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="frame-wrap">
                                <table class="table m-0">
                                    <thead class="thead-themed">
                                        <tr>
                                            <th>Nome Completo</th>
                                            <th>Status</th>
                                            <th>Horas</th>
                                            <th>Apto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acaoExtensaoOcorrencia->curricularizacao as $curricularizacao)
                                        <tr>
                                            <td>
                                                {{$curricularizacao->user->name}}
                                            </td>
                                            <td>
                                                {{$curricularizacao->status}}
                                            </td>
                                            <td>
                                                {{$curricularizacao->horas}}
                                            </td>
                                            <td>
                                                {{$curricularizacao->apto ? 'Sim' : 'Não'}}
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
                    </div>
                    @else
                    <div class="col-12 mt-2">
                        <div class="p-0">
                            <a href="{{ url('acoes-extensao-ocorrencia/'. $acaoExtensaoOcorrencia->id . '/curricularizacao/novo' ) }}" class="btn btn-md btn-success">Solicitar Participação</a>
                        </div>
                    </div>
                    @endif

                    <div class="col-12 mt-2">
                        <div class="p-0">
                            <h5>
                            <a href="/acoes-extensao/{{ $acaoExtensaoOcorrencia->acao_extensao->id }}" class="btn btn-md btn-info">
                                Ver Detalhes da Ação de Extensão <i class="far fa-chevron-double-right"></i>
                            </a>
                            </h5>
                        </div>
                    </div>
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection
