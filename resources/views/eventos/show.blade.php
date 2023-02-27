@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Gestão de Eventos</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-list'></i>Eventos</span>
        <small>
        Gestão dos eventos da PROEC
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
                            <div class="card-header" id="headingOne">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                        <i class="far fa-list icon-stack-1x opacity-100 color-success-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        Detalhes do Evento
                                    </h4>
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
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample"> 
                                <div class="card-body">
                                    <div class="col-12 flex-1">
                                        <span class="f-lg font-color-light">Título do Evento</span>
                                        <h1 class="fw-300 text-info">{{ $evento->titulo }}</h1>
                                    </div>
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
                                    @if( !is_null($evento->inscricao_inicio) )
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Inscrição
                                                <small class="mt-0 mb-3 d-flex flex-column">
                                                    <span>
                                                        <span class="fw-400">Período: </span>
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->inscricao_inicio)) }}
                                                        à 
                                                        {{ date('d/m/Y H:i:s', strtotime($evento->inscricao_fim)) }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Vagas: </span>
                                                        {{ $evento->vagas }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir documento: </span>
                                                        {{ is_null($evento->ck_documento) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Gênero: </span>
                                                        {{ is_null($evento->ck_sexo) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Identidade de Gênero: </span>
                                                        {{ is_null($evento->ck_identidade_genero) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Data de Nascimento: </span>
                                                        {{ is_null($evento->ck_nascimento) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Instituição de Origem: </span>
                                                        {{ is_null($evento->ck_instituicao) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Vinculo Unicamp: </span>
                                                        {{ is_null($evento->ck_vinculo) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Área de Atuação: </span>
                                                        {{ is_null($evento->ck_area) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Função/Cargo: </span>
                                                        {{ is_null($evento->ck_funcao) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir País de Origem: </span>
                                                        {{ is_null($evento->ck_pais) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Exigir Cidade/Estado: </span>
                                                        {{ is_null($evento->ck_cidade_estado) ? 'Não' : 'Sim' }}
                                                    </span>
                                                    <span>
                                                        <span class="fw-400">Personalizado: </span>
                                                        {{ is_null($evento->input_personalizado) ? '' : $evento->input_personalizado }}
                                                    </span>
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Certificado
                                                <small class="mt-0 mb-3 d-flex flex-column">
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-400">Modelo: </span>
                                                        <img src="{{ asset('storage/'.$evento->modelo_certificado->arquivo) }}" alt="{{ $evento->modelo_certificado->titulo }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
                                                    </div>
                                                    <div>
                                                        <span class="fw-400">Carga Horária: </span>
                                                        {{ $evento->carga_horaria }} Horas
                                                    </div>
                                                    <div>
                                                        <span class="fw-400">Exibir número do Documento do Inscrito no Certificado: </span>
                                                        {{ is_null($evento->doc_certificado) ? 'Não' : 'Sim' }}
                                                    </div>
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <a href="" class="btn btn-primary">Editar</a>
                                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
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