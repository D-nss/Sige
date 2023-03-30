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
        <span class="text-success"><i class='subheader-icon fal fa-list'></i>Inscrição de Evento</span>
        <small>
            Veja as informações da inscrição.
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
                                        Detalhes da Inscrição
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
                                    <div class="flex-1">
                                        <span class="f-lg font-color-light">Título do Evento</span>
                                        <h1 class="font-italic fw-300 text-info">{{ $inscrito->evento->titulo }}</h1>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            @if( !is_null($inscrito->confirmacao) )
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Status</span>
                                                        <br>
                                                        @if($inscrito->confirmacao == 1)
                                                            @if ($inscrito->lista_espera == 0)
                                                                <span class="badge badge-success badge-pill mt-0 mb-3">
                                                                    Confirmada
                                                                </span>
                                                            @else
                                                                <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                    Na lista de Espera
                                                                </span>
                                                            @endif
                                                        @elseif( $inscrito->confirmacao == 2)
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
                                                    </h5>
                                                </div>
                                            </div>
                                            @endif
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
                                            @if(!is_null($inscrito->nome_social))
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
                                            @if( !is_null($inscrito->instituicao) )
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
                                            @if( !is_null($inscrito->pais) )
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
                                        </div>
                                        <div class="col-md-3">
                                            @if( !is_null($inscrito->area) )
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
                                            @if( !is_null($inscrito->vinculo) )
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
                                            @if( !is_null($inscrito->nascimento) )
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
                                            @if( !is_null($inscrito->sexo) )
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
                                            @if( !is_null($inscrito->genero) )
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
                                            @if( !is_null($inscrito->funcao) )
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
                                            @if( !is_null($inscrito->municipio) )
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

                                        </div>
                                        <div class="col-md-3">
                                            @if( !is_null($inscrito->etnico_racial) )
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Autodeclaração Étnico Racial</span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                        {{ $inscrito->etnico_racial }}
                                                        </small>
                                                    </h5>
                                                </div>
                                            </div>
                                            @endif
                                            @if( !is_null($inscrito->deficiencia) )
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
                                            @if( !is_null($inscrito->desc_deficiencia) )
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
                                    </div>
                                    <hr>
                                    @if ($inscrito->lista_espera == 0)
                                    <div class="row">
                                        <div class="p-3 d-flex flex-row">
                                            <div class="d-block flex-shrink-0">
                                                {!! $qrcode !!}
                                                <div class="mt-3">
                                                    <a href="{{ url('inscritos/baixar_qrcode/' . $crypt) }}" class="btn btn-danger btn-block">Baixar QRCode</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <hr>
                                    @if(isset($inscrito->titulo_trabalho) && $inscrito->status_arquivo != 'Cancelado')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <h5>
                                                        <span class="font-color-light font-size-14">Título do Trabalho</span>
                                                        <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
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
                                            @if( !is_null($inscrito->arquivo) && $inscrito->status_arquivo != 'Cancelado' )

                                                <div class="col-12">
                                                    <div class="p-0">
                                                        <h5>
                                                            <span class="font-color-light">Arquivo</span>
                                                            <br>
                                                            <div class="mt-3">
                                                                <span class="mt-3 text-uppercase">Status Análise</span>
                                                                <br>
                                                                @if($inscrito->status_arquivo == 'Aceito')
                                                                    <span class="badge badge-success badge-pill mt-0 mb-3">
                                                                        {{ $inscrito->status_arquivo }}
                                                                    </span>
                                                                @elseif( $inscrito->status_arquivo == 'Pendente')
                                                                    <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                    {{ $inscrito->status_arquivo }}
                                                                    </span>
                                                                    <div class="col-12">
                                                                        <div class="p-0">
                                                                            <h5>
                                                                                <span class="font-color-light font-size-14">Ressalva</span>
                                                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                {{ $inscrito->arquivo_ressalva }}
                                                                                </small>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                @elseif( $inscrito->status_arquivo == 'Recusado')
                                                                    <span class="badge badge-danger badge-pill mt-0 mb-3">
                                                                    {{ $inscrito->status_arquivo }}
                                                                    </span>
                                                                    <div class="col-12">
                                                                        <div class="p-0">
                                                                            <h5>
                                                                                <span class="font-color-light font-size-14">Ressalva</span>
                                                                                <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                {!! nl2br( e($inscrito->arquivo_ressalva) ) !!}
                                                                                </small>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    @if($inscrito->recurso_arquivo == NULL)
                                                                        <button type="button" class="btn btn-md btn-primary mb-2" data-toggle="modal" data-target="#recursoModal">
                                                                            Abrir Recurso
                                                                        </button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="recursoModal" tabindex="-1" aria-labelledby="recursoModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <form action="{{ url('inscrito/recurso-arquivo/' . $inscrito->id) }}" method="POST">
                                                                                    <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="recursoModalLabel">Recurso Análise Arquivo</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">

                                                                                            @csrf

                                                                                            <div class="form-group">
                                                                                                <label for="arquivo_ressalva">Argumentação</label>
                                                                                                <textarea class="form-control" type="text" name="argumentacao" rows="10"></textarea>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                                        <button type="submit" class="btn btn-success">Enviar</button>
                                                                                    </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-12">
                                                                            <div class="p-0">
                                                                                <h5>
                                                                                    <span class="font-color-light font-size-14">Argumentação Recurso</span>
                                                                                    <small class="mt-0 mb-3 font-size-16 fw-400 text-uppercase">
                                                                                    {!! nl2br( e( $inscrito->recurso_arquivo) ) !!}
                                                                                    </small>
                                                                                </h5>
                                                                            </div>
                                                                        </div>

                                                                        @if($userNaComissao && $inscrito->resposta_recurso == NULL)
                                                                            <button type="button" class="btn btn-md btn-primary mb-2" data-toggle="modal" data-target="#aprovaRecursoModal">
                                                                                Análise Recurso
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="aprovaRecursoModal" tabindex="-1" aria-labelledby="aprovaRecursoModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <form action="{{ url('inscrito/avaliar-recurso/' . $inscrito->id) }}" method="POST">
                                                                                        <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="aprovaRecursoModalLabel">Análise Recurso</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">

                                                                                                @csrf
                                                                                                <select class="form-control" name="resposta_recurso">
                                                                                                    <option value="">Selecione ...</option>
                                                                                                    <option value="Aceito">Aceito</option>
                                                                                                    <option value="Recusado">Recusado</option>
                                                                                                </select>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                                            <button type="submit" class="btn btn-success">Enviar</button>
                                                                                        </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-warning badge-pill mt-0 mb-3">
                                                                        Em Análise
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <small class="mt-0 mb-3">
                                                                <div class="width-9 mb-2">
                                                                    <img src="{{ asset('smartadmin-4.5.1/img/pdf-icon.png') }}" class="img-fluid" alt="Arquivo PDF">
                                                                </div>

                                                                <a href="{{ url('storage/'.$inscrito->arquivo) }}" class="btn btn-danger" target="_blank">Abrir <i class="far fa-arrow-right ml-2"></i></a>
                                                            </small>
                                                            @if(
                                                                ($userNaComissao && $inscrito->status_arquivo == NULL)
                                                                ||
                                                                ($userNaComissao && $inscrito->status_arquivo == 'Em Análise')
                                                            )
                                                                <div class="mt-0 mb-3">
                                                                    <button type="button" class="btn btn-md btn-warning" data-toggle="modal" data-target="#exampleModal{{$inscrito->id}}">
                                                                        Analisar
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="exampleModal{{ $inscrito->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $inscrito->id }}" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <form action="{{ url('inscrito/arquivo-analise/' . $inscrito->id) }}" method="POST">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel{{ $inscrito->id }}">Analisar Arquivo</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <div class="form-group">
                                                                                            <label for="status_arquivo">Selecione o status</label>
                                                                                            <select class="form-control mb-2" name="status_arquivo" id="status_arquivo">
                                                                                                <option value="">Selecione ...</option>
                                                                                                <option value="Aceito">Aceito</option>
                                                                                                <option value="Pendente">Pendente</option>
                                                                                                <option value="Recusado">Recusado</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group" id="ressalva">
                                                                                            <label for="arquivo_ressalva">Ressalva</label>
                                                                                            <textarea class="form-control" type="text" name="arquivo_ressalva" rows="10"></textarea>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                                    <button type="submit" class="btn btn-success">Enviar</button>
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

                                            @if(
                                                ( 
                                                    $inscrito->evento->ck_arquivo == 1 
                                                    && 
                                                    strtotime(date('Y-m-d')) <= strtotime($inscrito->evento->prazo_envio_arquivo) 
                                                    && 
                                                    $inscrito->recurso_arquivo == NULL 
                                                    &&
                                                    $inscrito->status_arquivo != 'Aceito'
                                                )
                                                    ||
                                                ($inscrito->status_arquivo == 'Pendente' && $inscrito->arquivo_ressalva != NULL)
                                            )
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-12">
                                                        <div class="p-0">
                                                            <form action="{{ url('inscrito/upload-arquivo/' . $inscrito->id ) }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="form-label">Título do Trabalho<span class="text-danger">*</span></label>
                                                                    <div class="input-group bg-white shadow-inset-2">
                                                                        <input type="text" class="form-control bg-transparent" placeholder="Título do Trabalho" name="titulo_trabalho" value="{{old('titulo_trabalho')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <label class="control-label fw-500 text-success fs-xl">Upload de Projeto</label>
                                                                    <div class="preview-zone hidden">
                                                                    <div class="box box-solid">
                                                                        <div class="box-header with-border">
                                                                        <div></div>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-secondary btn-xs remove-preview">
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
                                                                                Arraste o arquivo aqui ou clique para selecionar.
                                                                                <br>
                                                                                @if($inscrito->arquivo != NULL)
                                                                                    <span class="text-info fs-xs fw-300">Caso deseje alterar o arquivo faça o upload novamente que o arquivo será substituido.</span>
                                                                                @endif
                                                                            </p>

                                                                        </div>
                                                                        <input type="file" name="arquivo" class="dropzone" id="arquivo" value="{{ old('arquivo') }}">

                                                                    </div>
                                                                    <div id="alert-pdf-format"></div>
                                                                    <div class="help-block muted">O envio do arquivo não é obrigatório, somente se você for apresentar algum projeto no evento.</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </div>

                                    </div>
                                    @if($inscrito->arquivo != NULL && $inscrito->status_arquivo != 'Cancelado')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-12">
                                                <div class="p-0 mt-3">
                                                    <button type="button" class="btn btn-md btn-warning" data-toggle="modal" data-target="#cancelaModal{{$inscrito->id}}">
                                                        Cancelar Apresentação de Projeto
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="cancelaModal{{ $inscrito->id }}" tabindex="-1" aria-labelledby="cancelaModalLabel{{ $inscrito->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ url('inscrito/cancelar-arquivo/' . $inscrito->id) }}" method="POST">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cancelaModalLabel{{ $inscrito->id }}">Cancelar Apresentação de Projeto</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                        @csrf
                                                                        @method('PUT')

                                                                        <p>Você deseja relamente cancelar sua apresentação de projeto?</p>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                    <button type="submit" class="btn btn-danger">Sim, Cancelar</button>
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
                                    @if( strtotime(date('Y-m-d')) > strtotime($inscrito->evento->data_fim) && $inscrito->presenca == 1 )
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-12">
                                                <div class="p-0">
                                                    <a href="{{ url('evento/'. $inscrito->evento->id .'/inscrito/'. $inscrito->id .'/certificado') }}" class="btn btn-success">Gerar Certificado</a>
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
    </div>
</div>

@endsection
