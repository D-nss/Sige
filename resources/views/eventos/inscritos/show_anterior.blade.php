@extends('layouts.app')

@section('title', 'Área do Inscrito')

@section('content')
    <div class="subheader">
        <!-- Apresentação simples para usuário visualizar melhor no mobile -->
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user'></i>Olá, {{ $inscrito->nome }}</span>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">

            </div>
        </div>
    </div>
    <!-- Menu horizontal para os inscritos (o sidebar é para os administradores/comissão dos eventos) -->
    <div class="demo demo-v-spacing-lg" style="padding-bottom: 20px;">
        <div class="btn-group btn-group-lg">
            <a href="{{ url('evento/inscrito/historico/' . \Illuminate\Support\Facades\Crypt::encryptString($inscrito->id) ) }}" class="btn btn-default waves-effect waves-themed"></span>Histórico<span
                    class="badge border border-light rounded-pill bg-primary-400 position-relative ml-2">{{ $participados->count() }}</span></a>
            <a href="{{ url('evento/inscrito/eventos/' . \Illuminate\Support\Facades\Crypt::encryptString($inscrito->id) ) }}" class="btn btn-default waves-effect waves-themed"></span>Inscriçõe Abertas</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-3" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                            <div class="ml-3">
                                <span class="font-color-light font-size-14">Título do Evento</span>
                                <h5 class="mb-0 flex-1 font-color-light fw-500">
                                    <small class="mt-0 mb-3 font-size-16 color-primary-700 fw-700 text-uppercase">
                                        {{ $inscrito->evento->titulo }}
                                    </small>
                                    <b>Confirmação de inscrição</b>
                                </h5>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Status da Inscrição</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                @if (!is_null($inscrito->confirmacao))
                                                    @if ($inscrito->confirmacao == 1)
                                                        @if ($inscrito->lista_espera == 0)
                                                            <span
                                                                class="badge border border-primary text-primary text-uppercase mt-0 mb-3">Confirmado</span>

                                                            <!--
                                                                        <span class="badge badge-success badge-pill mt-0 mb-3">
                                                                            Confirmada
                                                                        </span>-->
                                                        @else
                                                            <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                Na lista de Espera
                                                            </span>
                                                        @endif
                                                    @elseif($inscrito->confirmacao == 2)
                                                        <span class="badge badge-danger badge-pill mt-0 mb-3">
                                                            Cancelada
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                            Não Confirmada
                                                        </span>
                                                    @endif
                                                    @if ($inscrito->presenca == 1)
                                                        <span class="badge badge-primary badge-pill mt-0 mb-3">
                                                            Presente
                                                        </span>
                                                    @endif
                                                @endif
                                            </small>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Data e hora do início</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                {{ $diasSemana[date('D', strtotime($inscrito->evento->data_inicio))] }} ,
                                                {{ date('d', strtotime($inscrito->evento->data_inicio)) }} de
                                                {{ $meses[date('m', strtotime($inscrito->evento->data_inicio))] }} de
                                                {{ date('Y', strtotime($inscrito->evento->data_inicio)) }} às
                                                {{ date('H:i', strtotime($inscrito->evento->data_inicio)) }}</span>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Data e hora do término</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                {{ $diasSemana[date('D', strtotime($inscrito->evento->data_fim))] }} ,
                                                {{ date('d', strtotime($inscrito->evento->data_fim)) }} de
                                                {{ $meses[date('m', strtotime($inscrito->evento->data_fim))] }} de
                                                {{ date('Y', strtotime($inscrito->evento->data_fim)) }} às
                                                {{ date('H:i', strtotime($inscrito->evento->data_fim)) }}</span>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Local do Evento</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                {{ $inscrito->evento->local }}
                                            </small>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Endereço</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                <a href="https://www.google.com/maps?q={{ $inscrito->evento->latitude }},{{ $inscrito->evento->longitude }}"
                                                    style="text-decoration:none !important;" target="_blank">
                                                    {{ $inscrito->evento->endereco }}</a>
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                @if ($inscrito->lista_espera == 0)
                                    <div class="row">
                                        <div class="p-3 d-flex flex-row">
                                            <div class="d-block flex-shrink-0">
                                                {!! $qrcode !!}
                                                <div class="mt-3">
                                                    <a href="{{ url('inscritos/baixar_qrcode/' . $crypt) }}"
                                                        class="btn btn-primary btn-block"><i class="far fa-download"></i>
                                                        Baixar QRCode</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($inscrito->presenca == 0 && $inscrito->confirmacao != 2)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-12">

                                                <button type="button" class="btn btn-md btn-primary" data-toggle="modal"
                                                    data-target="#cancelaInscricaoModal{{ $inscrito->id }}">
                                                    Cancelar Inscrição
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="cancelaInscricaoModal{{ $inscrito->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="cancelaInscricaoModalLabel{{ $inscrito->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="cancelaInscricaoModalLabel{{ $inscrito->id }}">
                                                                    Cancelar inscrição ao evento</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Você deseja realmente cancelar inscricao ao evento?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Fechar</button>
                                                                <a href="{{ $linkNao }}" class="btn btn-danger">Sim,
                                                                    Cancelar</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-3" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5 class="mb-0 flex-1 color-primary-700 fw-700 text-uppercase">
                                            <b>Dados do inscrito</b>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Numero da Inscrição</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->id }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Inscrição Realizada</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->created_at }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Atualização</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->updated_at }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Nome Completo</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                {{ $inscrito->nome }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                @if (!is_null($inscrito->nome_social))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Nome Social</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                    {{ $inscrito->nome_social }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">E-Mail</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->email }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Tipo Documento</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->tipo_documento }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5>
                                            <span class="font-color-light font-size-14">Documento</span>
                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                {{ $inscrito->documento }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if (!is_null($inscrito->area))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Área</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->area }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->vinculo))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Vínculo</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->vinculo }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->nascimento))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Data Nascimento</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ date('d/m/Y', strtotime($inscrito->nascimento)) }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->sexo))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Sexo</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->sexo }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->genero))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Identidade de Gênero</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->genero }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if (!is_null($inscrito->funcao))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Função</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->funcao }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->etnico_racial))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Autodeclaração Étnico
                                                    Racial</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->etnico_racial }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->deficiencia))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Possui Deficiência?</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->deficiencia }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->desc_deficiencia))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Descrição Deficiência</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->desc_deficiencia }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-3">
                                @if (!is_null($inscrito->municipio))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Município</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->municipio }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->instituicao))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Instituição</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->instituicao }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->pais))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span class="font-color-light font-size-14">Pais</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->pais }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                @if (!is_null($inscrito->personalizado))
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                <span
                                                    class="font-color-light font-size-14">{{ $inscrito->evento->input_personalizado }}</span>
                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                    {{ $inscrito->personalizado }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-3" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5 class="mb-0 flex-1 color-primary-700 fw-700 text-uppercase">
                                            <b>Submissão de Trabalho</b>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                        <hr>
                                        @if (isset($inscrito->titulo_trabalho) && $inscrito->status_arquivo != 'Cancelado')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-12">
                                                        <div class="p-0">
                                                            <h5>
                                                                <span class="font-color-light font-size-14">Título do
                                                                    Trabalho</span>
                                                                <small
                                                                    class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                    {{ $inscrito->titulo_trabalho }}
                                                                </small>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if (!is_null($inscrito->arquivo) && $inscrito->status_arquivo != 'Cancelado')

                                                    <div class="col-12">
                                                        <div class="p-0">
                                                            <h5>
                                                                <span class="font-color-light">Arquivo</span>
                                                                <br>
                                                                <div class="mt-3">
                                                                    <span class="mt-3 text-uppercase">Status Análise</span>
                                                                    <br>
                                                                    @if ($inscrito->status_arquivo == 'Aceito')
                                                                        <span
                                                                            class="badge badge-success badge-pill mt-0 mb-3">
                                                                            {{ $inscrito->status_arquivo }}
                                                                        </span>
                                                                    @elseif($inscrito->status_arquivo == 'Pendente')
                                                                        <span
                                                                            class="badge badge-warning badge-pill mt-0 mb-3">
                                                                            {{ $inscrito->status_arquivo }}
                                                                        </span>
                                                                        <div class="col-12">
                                                                            <div class="p-0">
                                                                                <h5>
                                                                                    <span
                                                                                        class="font-color-light font-size-14">Ressalva</span>
                                                                                    <small
                                                                                        class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                        {{ $inscrito->arquivo_ressalva }}
                                                                                    </small>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    @elseif($inscrito->status_arquivo == 'Recusado')
                                                                        <span
                                                                            class="badge badge-danger badge-pill mt-0 mb-3">
                                                                            {{ $inscrito->status_arquivo }}
                                                                        </span>
                                                                        <div class="col-12">
                                                                            <div class="p-0">
                                                                                <h5>
                                                                                    <span
                                                                                        class="font-color-light font-size-14">Ressalva</span>
                                                                                    <small
                                                                                        class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                        {!! nl2br(e($inscrito->arquivo_ressalva)) !!}
                                                                                    </small>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                        @if ($inscrito->recurso_arquivo == null)
                                                                            <button type="button"
                                                                                class="btn btn-md btn-primary mb-2"
                                                                                data-toggle="modal"
                                                                                data-target="#recursoModal">
                                                                                Abrir Recurso
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="recursoModal"
                                                                                tabindex="-1"
                                                                                aria-labelledby="recursoModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <form
                                                                                        action="{{ url('inscrito/recurso-arquivo/' . $inscrito->id) }}"
                                                                                        method="POST">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title"
                                                                                                    id="recursoModalLabel">
                                                                                                    Recurso Análise Arquivo
                                                                                                </h5>
                                                                                                <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                                    <span
                                                                                                        aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">

                                                                                                @csrf

                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="arquivo_ressalva">Argumentação</label>
                                                                                                    <textarea class="form-control" type="text" name="argumentacao" rows="10"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Fechar</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-success">Enviar</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-12">
                                                                                <div class="p-0">
                                                                                    <h5>
                                                                                        <span
                                                                                            class="font-color-light font-size-14">Argumentação
                                                                                            Recurso</span>
                                                                                        <small
                                                                                            class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                            {!! nl2br(e($inscrito->recurso_arquivo)) !!}
                                                                                        </small>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                            @if ($userNaComissao && $inscrito->resposta_recurso == null)
                                                                                <button type="button"
                                                                                    class="btn btn-md btn-primary mb-2"
                                                                                    data-toggle="modal"
                                                                                    data-target="#aprovaRecursoModal">
                                                                                    Análise Recurso
                                                                                </button>

                                                                                <!-- Modal -->
                                                                                <div class="modal fade"
                                                                                    id="aprovaRecursoModal" tabindex="-1"
                                                                                    aria-labelledby="aprovaRecursoModalLabel"
                                                                                    aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <form
                                                                                            action="{{ url('inscrito/avaliar-recurso/' . $inscrito->id) }}"
                                                                                            method="POST">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title"
                                                                                                        id="aprovaRecursoModalLabel">
                                                                                                        Análise Recurso</h5>
                                                                                                    <button type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                        <span
                                                                                                            aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body">

                                                                                                    @csrf
                                                                                                    <select
                                                                                                        class="form-control"
                                                                                                        name="resposta_recurso">
                                                                                                        <option
                                                                                                            value="">
                                                                                                            Selecione ...
                                                                                                        </option>
                                                                                                        <option
                                                                                                            value="Aceito">
                                                                                                            Aceito</option>
                                                                                                        <option
                                                                                                            value="Recusado">
                                                                                                            Recusado
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button"
                                                                                                        class="btn btn-secondary"
                                                                                                        data-dismiss="modal">Fechar</button>
                                                                                                    <button type="submit"
                                                                                                        class="btn btn-success">Enviar</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        <span
                                                                            class="badge badge-warning badge-pill mt-0 mb-3">
                                                                            Em Análise
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <small class="mt-0 mb-3">
                                                                    <div class="width-9 mb-2">
                                                                        <img src="{{ asset('smartadmin-4.5.1/img/pdf-icon.png') }}"
                                                                            class="img-fluid" alt="Arquivo PDF">
                                                                    </div>

                                                                    <a href="{{ url('storage/' . $inscrito->arquivo) }}"
                                                                        class="btn btn-danger" target="_blank">Abrir <i
                                                                            class="far fa-arrow-right ml-2"></i></a>
                                                                </small>
                                                                @if (
                                                                    ($userNaComissao && $inscrito->status_arquivo == null) ||
                                                                        ($userNaComissao && $inscrito->status_arquivo == 'Em Análise'))
                                                                    <div class="mt-0 mb-3">
                                                                        <button type="button"
                                                                            class="btn btn-md btn-warning"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModal{{ $inscrito->id }}">
                                                                            Analisar
                                                                        </button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade"
                                                                            id="exampleModal{{ $inscrito->id }}"
                                                                            tabindex="-1"
                                                                            aria-labelledby="exampleModalLabel{{ $inscrito->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <form
                                                                                    action="{{ url('inscrito/arquivo-analise/' . $inscrito->id) }}"
                                                                                    method="POST">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel{{ $inscrito->id }}">
                                                                                                Analisar Arquivo</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                            @csrf
                                                                                            @method('PUT')

                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="status_arquivo">Selecione
                                                                                                    o status</label>
                                                                                                <select
                                                                                                    class="form-control mb-2"
                                                                                                    name="status_arquivo"
                                                                                                    id="status_arquivo">
                                                                                                    <option value="">
                                                                                                        Selecione ...
                                                                                                    </option>
                                                                                                    <option value="Aceito">
                                                                                                        Aceito</option>
                                                                                                    <option
                                                                                                        value="Pendente">
                                                                                                        Pendente</option>
                                                                                                    <option
                                                                                                        value="Recusado">
                                                                                                        Recusado</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="form-group"
                                                                                                id="ressalva">
                                                                                                <label
                                                                                                    for="arquivo_ressalva">Ressalva</label>
                                                                                                <textarea class="form-control" type="text" name="arquivo_ressalva" rows="10"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">Fechar</button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-success">Enviar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (
                                                    ($inscrito->evento->ck_arquivo == 1 &&
                                                        strtotime(date('Y-m-d')) <= strtotime($inscrito->evento->prazo_envio_arquivo) &&
                                                        $inscrito->recurso_arquivo == null &&
                                                        $inscrito->status_arquivo != 'Aceito') ||
                                                        ($inscrito->status_arquivo == 'Pendente' && $inscrito->arquivo_ressalva != null))
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-12">
                                                                <div class="p-0">
                                                                    <form
                                                                        action="{{ url('inscrito/upload-arquivo/' . $inscrito->id) }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label class="form-label">Título do
                                                                                Trabalho<span
                                                                                    class="text-danger">*</span></label>
                                                                            <div
                                                                                class="input-group bg-white shadow-inset-2">
                                                                                <input type="text"
                                                                                    class="form-control bg-transparent"
                                                                                    placeholder="Título do Trabalho"
                                                                                    name="titulo_trabalho"
                                                                                    value="{{ old('titulo_trabalho') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <label
                                                                                class="control-label fw-500 text-success fs-xl">Upload
                                                                                de Projeto</label>
                                                                            <div class="preview-zone hidden">
                                                                                <div class="box box-solid">
                                                                                    <div class="box-header with-border">
                                                                                        <div></div>
                                                                                        <div class="box-tools pull-right">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary btn-xs remove-preview">
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
                                                                                    <p class="fw-700">
                                                                                        Arraste o arquivo aqui ou clique
                                                                                        para selecionar.
                                                                                        <br>
                                                                                        @if ($inscrito->arquivo != null)
                                                                                            <span
                                                                                                class="text-info fs-xs fw-300">Caso
                                                                                                deseje alterar o arquivo
                                                                                                faça o upload novamente que
                                                                                                o arquivo será
                                                                                                substituido.</span>
                                                                                        @endif
                                                                                    </p>

                                                                                </div>
                                                                                <input type="file" name="arquivo"
                                                                                    class="dropzone" id="arquivo"
                                                                                    value="{{ old('arquivo') }}">

                                                                            </div>
                                                                            <div id="alert-pdf-format"></div>
                                                                            <div class="help-block muted">O envio do
                                                                                arquivo não é obrigatório, somente se você
                                                                                for apresentar algum projeto no evento.
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-success">Enviar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>

                                        </div>
                                        @if ($inscrito->arquivo != null && $inscrito->status_arquivo != 'Cancelado')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-12">
                                                        <div class="p-0 mt-3">
                                                            <button type="button" class="btn btn-md btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#cancelaModal{{ $inscrito->id }}">
                                                                Cancelar Apresentação de Projeto
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="cancelaModal{{ $inscrito->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="cancelaModalLabel{{ $inscrito->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form
                                                                        action="{{ url('inscrito/cancelar-arquivo/' . $inscrito->id) }}"
                                                                        method="POST">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="cancelaModalLabel{{ $inscrito->id }}">
                                                                                    Cancelar Apresentação de Projeto</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                @csrf
                                                                                @method('PUT')

                                                                                <p>Você deseja realmente cancelar sua
                                                                                    apresentação de projeto?</p>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Fechar</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Sim,
                                                                                    Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-3" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="col-12">
                                    <div class="p-0">
                                        <h5 class="mb-0 flex-1 color-primary-700 fw-700 text-uppercase">
                                            <b>Certificado</b>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                        <hr>
                        <div class="row g-4">
                            <div class="col-md-3">
                                @if (strtotime(date('Y-m-d')) > strtotime($inscrito->evento->data_fim) && $inscrito->presenca == 1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <a href="{{ url('evento/' . $inscrito->evento->id . '/inscrito/' . $inscrito->id . '/certificado') }}"
                                                    class="btn btn-success">Gerar Certificado</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-3" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 font-color-light fw-500">
                                    <small class="mt-0 mb-3 font-size-16 color-primary-700 fw-700 text-uppercase">
                                        Histórico dos Eventos Inscritos
                                    </small>
                                </h5>
                            </div>
                        </div>
                        <div class="panel-tag">
                            Acesse a inscrição dos eventos listados abaixo onde se inscreveu para ver mais detalhes e obter o <code>certificado</code>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-12">
                                    <table id="dt-inscrito-historico" class="table">
                                        <thead>
                                            <tr>
                                                <th>Título do Evento</th>
                                                <th>Data Inicio Evento</th>
                                                <th>Status Inscricao</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($participados as $dados_inscricao)
                                                <tr>
                                                    <td><a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($dados_inscricao->id) ) }}">
                                                            {{ $dados_inscricao->evento->titulo }}</a></td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($dados_inscricao->evento->data_inicio)) }}
                                                    </td>
                                                    <td>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase text-uppercase">
                                                            @if (!is_null($dados_inscricao->confirmacao))
                                                                @if ($dados_inscricao->confirmacao == 1)
                                                                    @if ($dados_inscricao->lista_espera == 0)
                                                                        <span
                                                                            class="badge border border-primary text-primary text-uppercase mt-0 mb-3">Confirmado</span>

                                                                        <!--
                                                                                    <span class="badge badge-success badge-pill mt-0 mb-3">
                                                                                        Confirmada
                                                                                    </span>-->
                                                                    @else
                                                                        <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                            Na lista de Espera
                                                                        </span>
                                                                    @endif
                                                                @elseif($inscrito->dados_inscricao == 2)
                                                                    <span class="badge badge-danger badge-pill mt-0 mb-3">
                                                                        Cancelada
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                        Não Confirmada
                                                                    </span>
                                                                @endif
                                                                @if ($inscrito->dados_inscricao == 1)
                                                                    <span class="badge badge-primary badge-pill mt-0 mb-3">
                                                                        Presente
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        </small>
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

@endsection
