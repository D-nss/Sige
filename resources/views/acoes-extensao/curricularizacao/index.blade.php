@extends('layouts.app')

@section('title', 'Listagem Curricularização das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item active">Listagem Curricularização das Ações de Extensão</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao-ocorrencia/{{ $acao_extensao_ocorrencia->id }}/curricularizacao/novo"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Cadastrar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Ações de Extensão
        <small>
            Listagem das curricularizações cadastradas da Ação de Extensão <span class="text-success">{{ $acao_extensao_ocorrencia->acao_extensao->titulo }}</span>
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
                                <th>Aluno</th>
                                <th>Status</th>
                                <th>Horas</th>
                                <th>Apto</th>
                                <th>Atualizado</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($curricularizacoes as $curricularizacao)
                                <tr>
                                    <td>
                                        <div class="fs-xl fw-700 text-primary">{{ $curricularizacao->aluno_ra['MALUCOMPL'] }}</div>
                                        <div class="fs-md text-success">{{ $curricularizacao->aluno_ra['NIVFORM'] }} - {{ $curricularizacao->aluno_ra['MUNIDENSI'] }}</div>
                                        <div class="fs-xs text-muted mb-1">{{ $curricularizacao->aluno_ra['SITALUNO'] }}</div>
                                                
                                        <!-- <button class="btn btn-warning btn-xs mb-2" type="button" data-toggle="collapse" data-target="#collapseCoeficientes{{ $curricularizacao->id }}" aria-expanded="false" aria-controls="collapseCoeficientes{{ $curricularizacao->id }}">
                                            Coeficientes DAC
                                        </button>
                                        <div class="collapse" id="collapseCoeficientes{{ $curricularizacao->id }}">
                                            <div class="card card-body d-flex flex-row">
                                                <div class="border border-danger rounded fw-700 mr-2 p-2">cp - 20%</div>
                                                <div class="border border-info rounded fw-700 mr-2 p-2">cpf - 30%</div>
                                                <div class="border border-primary rounded fw-700 mr-2 p-2">cpex - 40%</div> 
                                                <div class="border border-warning rounded fw-700 mr-2 p-2">cpfex - 50%</div> 
                                                <div class="border border-secondary rounded fw-700 mr-2 p-2">vcr - 60%</div>
                                                <div class="border border-success rounded fw-700 mr-2 p-2">crr - 70%</div>
                                            </div>
                                        </div> -->
                                    </td>
                                    <td class="align-middle">  
                                        <div class="
                                            badge 
                                            badge-pill 
                                            @switch($curricularizacao->status)
                                                @case('Aceito')
                                                    badge-success
                                                    @break
                                                @case('Não Aceito')
                                                    badge-danger
                                                    @break
                                                @case(null)
                                                    badge-warning
                                                    @break
                                            @endswitch
                                            p-1">
                                            {{ $curricularizacao->status ? $curricularizacao->status : 'Em Análise'}}
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-700">{{ $curricularizacao->horas }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @switch($curricularizacao->apto)
                                            @case(1)
                                                @if($curricularizacao->status == 'Aceito')
                                                    <form action='{{ url("/acoes-extensao-ocorrencia/curricularizacao/$curricularizacao->id/tornar-apto") }}' method="post">
                                                        @csrf
                                                        <button type="submit" class="btn text-info" {{ $curricularizacao->acao_extensao_ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}><i class="fal fa-thumbs-up fa-2x "></i></button>
                                                    </form>
                                                @else
                                                    <span class="ml-3 text-info"><i class="fal fa-thumbs-up fa-2x"></i></span>
                                                @endif
                                                @break
                                            @case(0)
                                            @if($curricularizacao->status == 'Aceito')
                                                    <form action='{{ url("/acoes-extensao-ocorrencia/curricularizacao/$curricularizacao->id/tornar-apto") }}' method="post">
                                                        @csrf
                                                        <button type="submit" class="btn font-color-light" {{ $curricularizacao->acao_extensao_ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}><i class="fal fa-thumbs-down fa-2x"></i></button>
                                                    </form>
                                                @else
                                                    <span class="ml-3 font-color-light"><i class="fal fa-thumbs-down fa-2x"></i></span>
                                                @endif
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary fs-nano font-italic">{{ date('d/m/Y H:i:s', strtotime($curricularizacao->updated_at)) }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#modalApresentacao{{ $curricularizacao->id }}" {{ $curricularizacao->acao_extensao_ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}>
                                        Carta Apresentação
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalApresentacao{{ $curricularizacao->id }}" tabindex="-1" role="dialog" aria-labelledby="modalApresentacao{{ $curricularizacao->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalApresentacao{{ $curricularizacao->id }}Label">Carta de Apresentação</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body">
                                                        {!! $curricularizacao->carta_apresentacao !!}                                                  
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal{{ $curricularizacao->id }}" {{ $curricularizacao->acao_extensao_ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}>
                                        Aceitar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $curricularizacao->id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $curricularizacao->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{ $curricularizacao->id }}Label">Aceitar Aluno na Curricularização</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action='{{ url("/acoes-extensao-ocorrencia/curricularizacao/$curricularizacao->id/aceitar") }}' method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="status" class="form-label">Status de aceite de aluno</label>
                                                            <select name="status" class="form-control" id="curricularizacao_status">
                                                                <option value="">Selecione ...</option>
                                                                <option value="Aceito">Aceito</option>
                                                                <option value="Não Aceito">Não Aceito</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group d-none" id="curricularizacao_justificativa" >
                                                            <label for="justificativa" class="form-label">Justificativa</label>
                                                            <textarea class="form-control" name="justificativa" rows="20"></textarea>
                                                        </div>                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-success">Enviar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($curricularizacao->status == 'Aceito')
                                        <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalApontar{{ $curricularizacao->id }}" {{ $curricularizacao->acao_extensao_ocorrencia->status == 'Encerrado' ? 'disabled' : '' }}>
                                            Apontar Horas
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalApontar{{ $curricularizacao->id }}" tabindex="-1" role="dialog" aria-labelledby="modalApontar{{ $curricularizacao->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalApontar{{ $curricularizacao->id }}Label">Apontamentos do Aluno na Curricularização</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action='{{ url("/acoes-extensao-ocorrencia/curricularizacao/$curricularizacao->id/apontar") }}' method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="apto" class="form-label">Aluno está apto?</label>
                                                            <select name="apto" class="form-control">
                                                                <option value="">Selecione ...</option>
                                                                <option value="1" {{ $curricularizacao->apto == 1 ? 'selected' : '' }}>Sim</option>
                                                                <option value="0" {{ $curricularizacao->apto == 0 ? 'selected' : '' }}>Não</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="apto" class="form-label">Horas executadas</label>
                                                            <input type="number" class="form-control" name="horas" placeholder="Somente números" value="{{ $curricularizacao->horas != null ? $curricularizacao->horas : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-success">Enviar</button>
                                                    </div>
                                                </form>
                                                </div>
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
@endsection
