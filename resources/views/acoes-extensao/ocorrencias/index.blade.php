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
        <div id="panel-1" class="panel">
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
                                <td>Ver detalhes<br>Editar<br>Equipe<br>{{isset($ocorrencia->fim_inscricoes) ? 'Curricularização' : ''}}</td>
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
