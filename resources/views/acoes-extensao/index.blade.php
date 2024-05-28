@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item text-primary">Ações de Extensão</li>
    <li class="breadcrumb-item active">Minhas Ações</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        Olá, {{ $user->name }}
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        @if(count($acoes_extensao_usuario) < 1)
                        <p>
                        Você ainda não criou nenhuma Ação de Extensão. Você pode começar clicando no botão abaixo
                        </p>
                        @else
                        <p>
                        Abaixo estão listadas suas Ações de Extensão, caso deseje cadastrar uma nova Ação de Extensão clique no botão abaixo
                        </p>
                        @endif
                        @if ($comissao_extensao)
                            <div class="form-group">
                                <a href="{{ url('acoes-extensao/novo') }}" class="btn btn-primary btn-pills ">
                                    <i class="far fa-plus-circle"></i>
                                    Nova Ação
                                </a>
                            </div>
                        @else
                            @if(!$user->hasRole('extensao-coordenador'))
                                <p class="color-danger-500">Botão "Nova Ação" ausente! A Comissão de Extensão não está cadastrada. Para solicitar o cadastramento da comissão, entre em contato com o Coordenador de Extensão da sua unidade.</p>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <!--Table head-->
            <div id="panel" class="panel">
                <div class="panel-hdr ">
                    <h2>
                        Minhas Ações de Extensão
                        <small class="text-muted">Para ver detalhes e atualizar os dados, clique sobre o registro na tabela abaixo</small>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <div class="row">
                                @if($acoes_extensao_usuario->where('status_comissao_graduacao', 'Sim')->whereNotNull('vagas_curricularizacao')->whereNotNull('qtd_horas_curricularizacao')->count())
                                <div class="col-12">
                                    <h5 class="text-muted">
                                        * Ações de Extensão que marcaram curricularização podem incluir ocorrências, as ocorrências são as datas e locais nos quais a ação de extensão irá acontecer, após a inclusão da ocorrência os alunos poderão se inscrever para curricularização.
                                    </h5>
                                </div>
                                @endif
                            </div>
                            <table class="table m-0">
                                <thead class="thead-themed">
                                    <tr>
                                        <th>#</th>
                                        <th>Título / Linha</th>
                                        <th>Modalidade / Área Temática</th>
                                        <th>Situação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($acoes_extensao_usuario) < 1)
                                    <tr>
                                        Não há Ações de Extensão suas cadastradas
                                    </tr>
                                    @else
                                    @foreach($acoes_extensao_usuario as $acao_extensao)
                                    <tr>
                                        <th scope="row">{{$acao_extensao->id}}</th>
                                        <td>
                                            <a href="/acoes-extensao/{{$acao_extensao->id}}" class="fs-lg fw-500 ">
                                                {{$acao_extensao->titulo}}
                                            </a>
                                            @if($acao_extensao->status == 'Pendente')

                                            <span class="fw-300 color-danger-500"><i class="fal fa-exclamation-circle"></i><i> Ação pendente!</i></span>

                                            @endif
                                            <div class="d-block text-muted fs-sm">
                                                Linha: <a href="/acoes-extensao/linhas/{{$acao_extensao->linha_extensao->id}}" class="fs-xs fw-400 text-dark">{{$acao_extensao->linha_extensao->nome}}</a>
                                                <br>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="/acoes-extensao/modalidades/{{$acao_extensao->modalidade}}" class="text-success">
                                                @switch($acao_extensao->modalidade)
                                                    @case(1)
                                                        Programa
                                                        @break
                                                    @case(2)
                                                        Projeto
                                                        @break
                                                    @case(3)
                                                        Curso
                                                        @break
                                                    @case(4)
                                                        Evento
                                                        @break
                                                    @case(5)
                                                        Prestação de serviços
                                                        @break
                                                    @default
                                                        Indefinido
                                                @endswitch
                                            </a>
                                            @foreach ($acao_extensao->areas_tematicas as $area_tematica)
                                            <a href="/acoes-extensao/areas/{{$area_tematica->id}}" class="text-muted small text-truncate">
                                            <br>{{$area_tematica->nome}}
                                            </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($acao_extensao->status_avaliacao_conext == 'Reconhecido' || $acao_extensao->ciencia_status == 'Reconhecido')
                                                <span class="badge badge-primary">Reconhecido ProEC</span>
                                            @elseif($acao_extensao->status == 'Aprovado')
                                                <span class="badge badge-primary">Aprovado Unidade</span>
                                            @elseif($acao_extensao->status == 'Pendente')
                                                <span class="badge badge-secondary">Aguardando parecer Unidade</span>
                                            @elseif($acao_extensao->status == 'Rascunho')
                                                <span class="badge badge-secondary">Rascunho</span>
                                            @endif
                                            <div class="text-muted small text-truncate">
                                                Atualizado: {{$acao_extensao->updated_at->format('d/m/Y')}}
                                            </div>
                                        </td>
                                        <td>
                                            @if($user->id == $acao_extensao->user_id)
                                                @if($acao_extensao->status == 'Rascunho')
                                                    <a
                                                        href="{{ url('acoes-extensao/'. $acao_extensao->id .'/editar') }}"
                                                        class="btn btn-primary btn-pills waves-effect waves-themed fs-xl "
                                                        data-toggle="tooltip"
                                                        data-placement="bottom"
                                                        title=""
                                                        data-original-title="Editar Registro"
                                                    >
                                                        <!-- <i class="fal fa-file-edit"></i> -->
                                                        Editar Registro
                                                    </a>
                                                @endif
                                                @if($acao_extensao->status == 'Aprovado')
                                                    <a
                                                        href="{{ url('acoes-extensao/'. $acao_extensao->id .'/ocorrencias') }}"
                                                        class="btn btn-primary btn-pills waves-effect waves-themed fs-xl "
                                                        data-toggle="tooltip"
                                                        data-placement="bottom"
                                                        title=""
                                                        data-original-title="Ocorrências"
                                                    >
                                                    <!-- <i class="fal fa-clipboard-list-check"></i> -->
                                                    Ocorrências
                                                    </a>
                                                @endif
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal{{ $acao_extensao->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $acao_extensao->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{route('acao_extensao.destroy', ['acao_extensao' => $acao_extensao->id])}}" method="post">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel{{ $acao_extensao->id }}">Alerta</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <p>Deseja realmente remover a ação?</p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                @if($acao_extensao->status == 'Rascunho' && $acao_extensao->ocorrencia->count() == 0)
                                                    <button type="button" class="btn btn-danger btn-pills waves-effect waves-themed fs-xl" data-toggle="modal" data-target="#modal{{ $acao_extensao->id }}">
                                                        <!-- <i class="fal fa-trash-alt"></i> -->
                                                        Remover
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $acoes_extensao_usuario->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
