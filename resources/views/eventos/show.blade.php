@extends('layouts.app')

@section('title', 'Detalhes do Evento')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Gestão de Eventos</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-calendar-day'></i>{{$evento->titulo}}
            <small>
                Detalhes do Evento
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="mt-3">
                    <div class="frame-wrap w-100">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Local</span>
                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $evento->local }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5 class="d-flex flex-column">
                                                    <span class="font-color-light font-size-14">Data</span>

                                                    <small class="mt-0 mb-3 font-size-16 fw-400">
                                                        <span class="font-color-light font-size-12">Início</span>
                                                        <br>
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->data_inicio)) }}
                                                        <br>
                                                        <span class="font-color-light font-size-12">Fim</span>
                                                        <br>
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->data_fim)) }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h6>
                                                    <span class="mt-0 mb-3 text-secondary d-flex flex-column">
                                                        <span class="font-color-light font-size-14">
                                                            Gratuito
                                                        </span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ is_null($evento->gratuito) ? 'Não' : 'Sim' }}
                                                        </small>
                                                        @if (isset($evento->valor_inscricao))
                                                            <span class="font-color-light font-size-14">
                                                                Valor Inscrição
                                                            </span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                R$
                                                                {{ number_format($evento->valor_inscricao, 2, ',', '.') }}
                                                            </small>
                                                        @endif
                                                        <span class="font-color-light font-size-14">
                                                            Online
                                                        </span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ is_null($evento->online) ? 'Não' : 'Sim' }}
                                                        </small>
                                                        <span class="font-color-light font-size-14">
                                                            Hibrído
                                                        </span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                            {{ is_null($evento->hibrido) ? 'Não' : 'Sim' }}
                                                        </small>
                                                    </span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Detalhes</span>
                                                    <small class="mt-0 mb-3 border rounded p-3">
                                                        {!! nl2br($evento->detalhes) !!}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        @if (!is_null($evento->inscricao_inicio))
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Inscrição</span>
                                                        <small class="mt-0 mb-3 d-flex flex-column">
                                                            <span>
                                                                <small class="mt-0 mb-3 font-size-16 fw-400">
                                                                    <span
                                                                        class="font-color-light font-size-12">Início</span>
                                                                    <br>
                                                                    {{ date('d/m/Y H:i:s', strtotime($evento->inscricao_inicio)) }}
                                                                    <br>
                                                                    <span class="font-color-light font-size-12">Fim</span>
                                                                    <br>
                                                                    {{ date('d/m/Y H:i:s', strtotime($evento->inscricao_fim)) }}
                                                                </small>
                                                            </span>

                                                            <span class="font-color-light font-size-14">Vagas</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->vagas) ? "Ilimitado" : $evento->vagas }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir
                                                                documento</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_documento) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Gênero</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_sexo) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Identidade de
                                                                Gênero</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_identidade_genero) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Data de
                                                                Nascimento</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_nascimento) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Instituição
                                                                de
                                                                Origem</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_instituicao) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Vinculo
                                                                Unicamp</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_vinculo) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Área de
                                                                Atuação</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_area) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir
                                                                Função/Cargo</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_funcao) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir País de
                                                                Origem</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_pais) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir
                                                                Cidade/Estado</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_cidade_estado) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir
                                                                Autodeclaração
                                                                Étnico Racial</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_racial) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir Declaração
                                                                de
                                                                Deficiência</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_deficiencia) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Exigir
                                                                Arquivo</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->ck_arquivo) ? 'Não' : 'Sim' }}
                                                            </small>

                                                            <span class="font-color-light font-size-14">Data Limite Envio
                                                                Arquivo</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->prazo_envio_arquivo) ? '' : date('d/m/Y H:i:s', strtotime($evento->prazo_envio_arquivo)) }}
                                                            </small>

                                                            <span
                                                                class="font-color-light font-size-14">Personalizado</span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->input_personalizado) ? '' : $evento->input_personalizado }}
                                                            </small>
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    <span class="font-color-light font-size-14">Certificado</span>
                                                    <small class="mt-0 mb-3 d-flex flex-column">
                                                        <div class="d-flex flex-column">
                                                            <span class="font-color-light font-size-12">Modelo: </span>
                                                            <img src="{{ asset('storage/' . $evento->certificado->arquivo) }}"
                                                                alt="{{ $evento->certificado->titulo }}"
                                                                class="img-fluid img-thumbnail" style="max-width: 200px;">
                                                        </div>
                                                        <div>
                                                            <span class="font-color-light font-size-12">Carga Horária:
                                                            </span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ $evento->carga_horaria }} Horas
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <span class="font-color-light font-size-12">Exibir número do
                                                                Documento do Inscrito no Certificado: </span>
                                                            <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                {{ is_null($evento->doc_certificado) ? 'Não' : 'Sim' }}
                                                            </small>
                                                        </div>
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        @hasrole($evento->grupo_usuario, 'web_user')
                                            <a href="{{ url('/eventos/' . $evento->id . '/editar') }}"
                                                class="btn btn-primary"><span
                                                class="fal fa-pencil mr-1"></span>Editar</a>
                                        @endhasanyrole
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
