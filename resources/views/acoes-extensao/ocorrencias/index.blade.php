@extends('layouts.app')

@section('title', 'Ocorrências - Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">Ações de Extensão</li>
    <li class="breadcrumb-item active">Ocorrências e Curricularização</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao/{{$acao_extensao->id}}/ocorrencias/novo"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Cadastrar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> {{$acao_extensao->titulo}}
        <small>
            Listagem das Ocorrências da Ação de Extensão
        </small>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <a class="btn btn-success btn-lg btn-icon rounded-circle" href="{{ url('/acoes-extensao/'. $acao_extensao->id . '/ocorrencias/novo') }}"><i class="far fa-plus"></i></a> Adicionar Ocorrência <br>
        </div>
    </div>
  <div class="row">
    <div class="col-xl-12">
        
        <div id="panel-1" class="panel mt-2">
            <div class="panel-hdr">
                <h2>
                    Para ver detalhes e atualizar os dados, clique sobre o registro na tabela abaixo
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <!-- datatable start -->
                    <table id="dt-acoes-extensao" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                 <th class="text-uppercase text-muted py-2 px-3">Inicio</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Fim</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Local</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Inicio (Inscrições)</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Fim (Inscrições)</th>
                                 <th class="text-uppercase text-muted py-2 px-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ocorrencias as $ocorrencia)
                            <tr >
                                <td>{{$ocorrencia->data_hora_inicio->format('d/m/Y - H:i')}}</td>
                                <td>{{$ocorrencia->data_hora_fim->format('d/m/Y - H:i')}}</td>
                                <td>{{$ocorrencia->local}}</td>
                                <td>{{isset($ocorrencia->inicio_inscricoes) ? $ocorrencia->inicio_inscricoes->format('d/m/Y - H:i') : 'Sem curricularização'}}</td>
                                <td>{{isset($ocorrencia->fim_inscricoes) ? $ocorrencia->fim_inscricoes->format('d/m/Y - H:i') : 'Sem curricularização'}}</td>
                                <td>
                                    <a href="{{ url('acoes-extensao/ocorrencias/'. $ocorrencia->id ) }}" class="btn btn-xs btn-info">Ver Detalhes</a>
                                    @if($ocorrencia->acao_extensao->user_id === $user->id)
                                        <a href="{{ url('acoes-extensao/ocorrencias/'. $ocorrencia->id .'/editar') }}" class="btn btn-primary btn-xs {{ $ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}">Editar</a>
                                        <a href="{{ url('acoes-extensao-ocorrencia/'. $ocorrencia->id .'/equipe') }}" class="btn btn-success btn-xs {{ $ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}">Equipe</a>
                                        <a href="{{ url('/acoes-extensao-ocorrencia/'. $ocorrencia->id .'/curricularizacao') }}" class="btn btn-xs btn-warning">{{isset($ocorrencia->fim_inscricoes) ? 'Curricularização' : ''}}</a>

                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal{{ $ocorrencia->id }}">
                                            Encerrar
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $ocorrencia->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $ocorrencia->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('acao_extensao.ocorrencias.encerrar', ['acaoExtensaoOcorrencia' => $ocorrencia]) }}" method="post">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel{{ $ocorrencia->id }}">Alerta</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                            @csrf
                                                            <p>Deseja encerrar a ocorrência de <span class="fw-500 text-info">{{ $ocorrencia->data_hora_inicio->format('d/m/Y H:i') }} </span> à <span class="fw-500 text-info">{{ $ocorrencia->data_hora_fim }}</span>?</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-danger">Confirmar o Encerramento</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- datatable end -->
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
