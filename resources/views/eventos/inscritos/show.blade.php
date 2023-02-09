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
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Evento
                                                <small class="mt-0 mb-3 text-primary">
                                                {{ $inscrito->evento->titulo }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Nome
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->nome }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            E-Mail
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->email }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Tipo Documento
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->tipo_documento }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Documento
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->documento }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @if( !is_null($inscrito->instituicao) )
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                            Instituição
                                                <small class="mt-0 mb-3">
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
                                            Pais
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->pais }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @endif
                                    @if( !is_null($inscrito->area) )
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Área
                                                <small class="mt-0 mb-3">
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
                                                Vínculo
                                                <small class="mt-0 mb-3">
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
                                                Data Nascimento
                                                <small class="mt-0 mb-3">
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
                                                Sexo
                                                <small class="mt-0 mb-3">
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
                                                Identidade de Gênero
                                                <small class="mt-0 mb-3">
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
                                                Função
                                                <small class="mt-0 mb-3">
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
                                                Município
                                                <small class="mt-0 mb-3">
                                                {{ $inscrito->municipio }}
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @endif
                                    @if( !is_null($inscrito->confirmacao) )
                                    <div class="col-12">
                                        <div class="p-0">
                                                @if($inscrito->confirmacao == 1)
                                                    <span class="badge badge-success badge-pill">
                                                        Confirmada
                                                    </span>
                                                @elseif( $inscrito->confirmacao == 2)
                                                    <span class="badge badge-danger badge-pill">
                                                        Cancelada
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning badge-pill">
                                                        Não Confirmada
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    @endif
                                    @if( !is_null($inscrito->arquivo) )
                                    <div class="col-12">
                                        <div class="p-0">
                                            <h5>
                                                Arquivo
                                                <small class="mt-0 mb-3">
                                                <a href="{{ url('storage/'.$inscrito->arquivo) }}" class="btn btn-danger">Arquivo PDF</a> 
                                                </small>
                                            </h5>
                                        </div>
                                    </div>
                                    @else
                                        @if( !!$inscrito->evento->ck_arquivo && strtotime(date('Y-m-d')) <= strtotime($inscrito->evento->prazo_envio_arquivo) )
                                        <form action="{{ url('inscrito/upload-arquivo/' . $inscrito->id ) }}" method="post" enctype="multipart/form-data"> 
                                        @csrf
                                        <div class="form-group">
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
                                                    <i class="glyphicon glyphicon-download-alt"></i>
                                                    <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
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
                                        @endif
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