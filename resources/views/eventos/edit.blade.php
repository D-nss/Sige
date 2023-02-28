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
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Eventos</span>
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
                                        @if(isset($evento))
                                            <i class="far fa-edit icon-stack-1x opacity-100 color-success-500"></i>
                                        @else
                                            <i class="far fa-plus icon-stack-1x opacity-100 color-success-500"></i>
                                        @endif
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        @if(isset($evento))
                                            Editar Evento
                                        @else
                                            Novo Evento
                                        @endif
                                    </h4>
                                    <span class="ml-auto disable">
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
                                    @if(isset($evento))
                                        <form action="{{ url('eventos/' . $evento->id ) }}" method="post" enctype="multipart/form-data">
                                            @method('PUT')
                                    @else
                                        <form action="{{ route('eventos.store') }}" method="post" enctype="multipart/form-data">
                                    @endif
                                    
                                        @csrf
                                        <h3>Preencha corretamente o formulário com as informações sobre o evento nos campos correspondentes</h3>
                                        <div class="form-group">
                                            <label for="titulo" class="fw-700">Título do Evento</label>
                                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" placeholder="Digite o título do Evento. Máximo: 100 caracteres." @if(isset($evento))value="{{ $evento->titulo }}"@endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="local" class="fw-700">Local do Evento</label>
                                            <input type="text" class="form-control @error('local') is-invalid @enderror" name="local" placeholder="Digite o local do Evento." value="@if(isset($evento)){{ $evento->local }}@endif">
                                        </div>
                                        <div class="form-group border rounded p-3">
                                        
                                            <label for="local" class="fw-700"><i class="far fa-check-circle fa-1x mr-2"></i>Tipo do Evento</label>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="gratuito" name="gratuito" value="1" @if(isset($evento) && $evento->gratuito == 1) checked="true" @endif>
                                                <label class="custom-control-label" for="gratuito">
                                                    Gratuito
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="online" name="online" value="1" @if(isset($evento) && $evento->online == 1) checked="true" @endif>
                                                <label class="custom-control-label" for="online">
                                                    On-line
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="hibrido" name="hibrido" value="1" @if(isset($evento) && $evento->hibrido == 1) checked="true" @endif>
                                                <label class="custom-control-label" for="hibrido">
                                                    Híbrido
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group border rounded p-3">
                                            <label for="local" class="fw-700"><i class="far fa-calendar-alt mr-2"></i>Período do Evento</label>
                                            <div class="form-input">
                                                <label class="form-label fw-400" for="data_inicio">
                                                    Inicio do Evento
                                                </label>
                                                <input class="form-control @error('data_inicio') is-invalid @enderror w-25" type="datetime-local" id="data_inicio" name="data_inicio" @if(isset($evento))value="{{ $evento->data_inicio }}"@endif>
                                                
                                            </div>
                                            <div class="form-input mt-2">
                                                <label class="form-label fw-400" for="data_fim">
                                                    Fim do Evento
                                                </label>
                                                <input class="form-control @error('data_fim') is-invalid @enderror w-25" type="datetime-local" id="data_fim" name="data_fim" @if(isset($evento))value="{{ $evento->data_fim }}"@endif>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label fw-700" for="detalhes">Detalhes (Notas do Evento, Programação, Palestrantes):</label>
                                            <div class=" @error('data_fim') border border-danger rounded p-3 @enderror">
                                                <textarea name="detalhes" id="detalhes" rows="10" cols="80">
                                                    @if(isset($evento)){{ $evento->detalhes }}@endif
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group border rounded p-3">
                                            <label for="inscricao" class="fw-700"><i class="far fa-edit mr-2"></i>Inscrições</label>
                                            <div class="custom-control custom-switch mb-3">
                                                <input class="custom-control-input" type="checkbox" id="inscricao" @if(isset($evento->inscricao_inicio)) checked  @endif>
                                                <label class="custom-control-label" for="inscricao">
                                                    Terá Inscrição?
                                                </label>
                                            </div>
                                            <div class="@if(!isset($evento->inscricao_inicio)) d-none @endif" id="evento_inscricao">
                                                <div class="form-input">
                                                    <label class="form-label fw-400" for="inscricao_inicio">
                                                        Inscricão Inicio
                                                    </label>
                                                    <input class="form-control @error('inscricao_inicio') is-invalid @enderror w-25" type="datetime-local" id="inscricao_inicio" name="inscricao_inicio" @if(isset($evento->inscricao_inicio)) value="{{ $evento->inscricao_inicio }}" @endif>
                                                    
                                                </div>
                                                <div class="form-input mt-2">
                                                    <label class="form-label fw-400" for="inscricao_fim">
                                                        Inscrição Fim
                                                    </label>
                                                    <input class="form-control @error('inscricao_fim') is-invalid @enderror w-25" type="datetime-local" id="inscricao_fim" name="inscricao_fim" @if(isset($evento->inscricao_inicio)) value="{{ $evento->inscricao_fim }}" @endif>
                                                    
                                                </div>
                                                <div class="form-input mt-3">
                                                    <label class="form-label fw-400" for="vagas">
                                                        Limite de inscritos:
                                                    </label>
                                                    <input class="form-control @error('vagas') is-invalid @enderror w-25" type="number" name="vagas" id="vagas" placeholder="Ilimitado"  @if(isset($evento->inscricao_inicio)) value="{{ $evento->vagas }}" @endif>
                                                    
                                                    <div class="mt-3">
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_documento" name="ck_documento" value="1" @if(isset($evento->ck_documento)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_documento">
                                                                Exigir Documento (Inscrito insere um de seus documentos: RG/CPF/Passaporte)
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_sexo" name="ck_sexo" value="1" @if(isset($evento->ck_sexo)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_sexo">
                                                                Exigir Sexo
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_identidade_genero" name="ck_identidade_genero" value="1" @if(isset($evento->ck_identidade_genero)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_identidade_genero">
                                                                Exigir Identidade de Gênero
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_nascimento" name="ck_nascimento" value="1" @if(isset($evento->ck_nascimento)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_nascimento">
                                                                Exigir Data de Nascimento
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_instituicao" name="ck_instituicao" value="1" @if(isset($evento->ck_instituicao)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_instituicao">
                                                                Exigir Instituição de Origem
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_vinculo" name="ck_vinculo" value="1" @if(isset($evento->ck_vinculo)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_vinculo">
                                                                Exigir Vinculo Unicamp
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_area" name="ck_area" value="1" @if(isset($evento->ck_area)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_area">
                                                                Exigir Área de Atuação
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_funcao" name="ck_funcao" value="1" @if(isset($evento->ck_funcao)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_funcao">
                                                                Exigir Função/Cargo
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch"> 
                                                            <input class="custom-control-input" type="checkbox" id="ck_pais" name="ck_pais" value="1" @if(isset($evento->ck_pais)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_pais">
                                                                Exigir País de Origem
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_cidade_estado" name="ck_cidade_estado" value="1" @if(isset($evento->ck_cidade_estado)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_cidade_estado">
                                                                Exigir Cidade/Estado
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-switch">
                                                            <input class="custom-control-input" type="checkbox" id="ck_arquivo" name="ck_arquivo" value="1" @if(isset($evento->ck_arquivo)) checked @endif>
                                                            <label class="custom-control-label mb-2" for="ck_arquivo">
                                                                Exigir Arquivo de Projeto
                                                            </label>
                                                        </div>
                                                        <div class="form-group {{ isset($evento->ck_arquivo) ? 'd-block' : 'd-none' }}" id="div_prazo_envio_arquivo">
                                                            <label class="form-label fw-400" for="prazo_envio_arquivo">
                                                                Prazo para envio de arquivo 
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control @error('prazo_envio_arquivo') is-invalid @enderror w-25" type="date" name="prazo_envio_arquivo" id="prazo_envio_arquivo" @if(isset($evento->prazo_envio_arquivo)) value="{{ $evento->prazo_envio_arquivo }}" @endif>
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label class="form-label fw-400" for="input_personalizado">
                                                                Campo Personalizado
                                                            </label>
                                                            <input class="form-control" type="text" name="input_personalizado" id="input_personalizado" placeholder="Digite o texto do campo personalizado ..." @if(isset($evento->input_personalizado)) value="{{ $evento->input_personalizado }}" @endif >
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group border rounded p-3">
                                            <label for="inscricao_inicio" class="fw-700"><i class="far fa-file-certificate mr-2"></i>Certificado</label>
                                            <div class="custom-control custom-switch mb-3">
                                                <input class="custom-control-input" type="checkbox" id="certificado" @if(isset($evento->carga_horaria)) checked @endif>
                                                <label class="custom-control-label" for="certificado">
                                                    Terá Certificado?
                                                </label>

                                            </div>
                                                 
                                            <div class="@if(!isset($evento->carga_horaria)) d-none @endif" id="evento_certificado">
                                                <div class="custom-control custom-switch mb-3">
                                                    <input class="custom-control-input" type="checkbox" id="enviar_modelo" @if(isset($evento->certificado)) checked @endif>
                                                    <label class="custom-control-label" for="enviar_modelo">
                                                        Enviar modelo
                                                    </label>

                                                </div>
                                                <div class="form-group @if(!isset($evento->certificado) && !$evento->certificado) d-none @endif " id="carregar_modelo">
                                                    <label class="control-label font-weight-bold text-success">Upload do modelo do certificado</label>
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
                                                        @if(isset($evento->certificado->arquivo) && !!$evento->certificado->arquivo)
                                                            <img src="{{ url('storage/' . $evento->certificado->arquivo) }}" alt="{{ $evento->certificado->titulo}}" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                                        @endif
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="dropzone-wrapper">
                                                        <div class="dropzone-desc">
                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                            <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
                                                        </div>
                                                        <input type="file" name="modelo" class="dropzone" id="modelo" value="{{ old('modelo') }}">
                                                        
                                                    </div>
                                                    <div id="alert-pdf-format"></div>
                                                </div> 
                                                <label class="form-label fw-400" for="carga_horaria">
                                                    Carga Horária:
                                                </label>
                                                <input class="form-control w-25" type="number" name="carga_horaria" id="carga_horaria" placeholder="Em horas" pattern="[0-9]" @if(isset($evento->carga_horaria)) value="{{$evento->carga_horaria}}" @endif>
                                                <div class="custom-control custom-switch mb-3">
                                                    <input class="custom-control-input" type="checkbox" id="doc_certificado" name="doc_certificado" value="1" @if(isset($evento->doc_certificado)) checked @endif>
                                                    <label class="custom-control-label mt-2" for="doc_certificado">
                                                        Exibir número do Documento do Inscrito no Certificado
                                                    </label>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Atualizar
                                        </button>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#exampleModal{{ $evento->id }}">
                                            Cancelar Evento
                                        </button>
                                    </form>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $evento->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $evento->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ url('eventos/' . $evento->id)}}" method="post">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel{{ $evento->id }}">Alerta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Deseja cancelar o evento <span class="fw-500">{{ $evento->titulo }}</span>?</p>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-danger">Confirmar Cancelamento</button>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div> 
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