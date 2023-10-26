@extends('layouts.app')

@section('title', 'Novo Evento')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Novo</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-calendar-plus'></i> Novo Evento
            <small>
                Por gentileza, preencha o formulário abaixo.
            </small>
        </h1>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="mt-3">
                <div class="frame-wrap w-100">
                    <div class="card-body">
                        <form action="{{ route('eventos.store') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="panel-tag">
                                Complete de forma adequada o formulário com as informações relacionadas ao evento nos campos
                                correspondentes.
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="fw-700">Título do Evento <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                                    name="titulo" id="titulo"
                                    placeholder="Digite o título do Evento. Máximo: 100 caracteres."
                                    value="{{ old('titulo') }}">
                            </div>

                            <div class="form-group border rounded p-3">

                                <div class="form-group">
                                    <label class="fw-700"><i class="far fa-map-marker-alt fa-1x mr-2"></i>Local do
                                        Evento</label>
                                    <input type="text" class="form-control @error('local') is-invalid @enderror"
                                        name="local" placeholder="Digite o nome do local do Evento."
                                        value="{{ old('local') }}">
                                </div>
                                <!--<div class="alert alert-info" role="alert">
                                            <ul id="suggestions-list">Ao inserir as informações no campo de endereço, você verá uma lista de sugestões abaixo. Clique na opção correspondente para preencher automaticamente os campos restantes (latitude e longitude) e receber auxílio.</ul>
                                        </div>-->
                                <div class="form-group">
                                    <label class="fw-700">Endereço</label>
                                    <input type="text" class="form-control @error('endereco') is-invalid @enderror"
                                        id="endereco" name="endereco" placeholder="Digite o endereço do local do Evento."
                                        value="{{ old('endereco') }}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="fw-700">Latitude</label>
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                            id="latitude" name="latitude" placeholder="Latitude."
                                            value="{{ old('latitude') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="fw-700">Longitude</label>
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                            id="longitude" name="longitude" placeholder="Longitude"
                                            value="{{ old('longitude') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="fw-700">Conferir coordenadas no mapa</label>
                                        <button id="open-map-button" type="button" class="col-md-12 btn btn-primary waves-effect waves-themed">
                                            <span class="fal fa-external-link mr-1"></span> Abrir Mapa</button>
                                    </div>
                                </div>
                                <br>

                            </div>

                            <div class="form-group border rounded p-3">

                                <label class="fw-700"><i class="far fa-check-circle fa-1x mr-2"></i>Tipo do Evento</label>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="gratuito" name="gratuito"
                                        value="1" checked>
                                    <label class="custom-control-label" for="gratuito">
                                        Gratuito
                                    </label>
                                </div>
                                <div class="form-group d-none" id="div_valor_inscricao">
                                    <label class="form-label fw-400" for="valor_inscricao">
                                        Valor da Inscrição:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('valor_inscricao') is-invalid @enderror w-25"
                                        name="valor_inscricao" id="valor_inscricao" placeholder="R$ 0"
                                        value="{{ old('valor_inscricao') }}">
                                    <span class="text-danger" id="msg_erro_valor_inscricao"></span>
                                </div>

                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="online" name="online"
                                        value="1" {{ old('online') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="online">
                                        On-line
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="hibrido" name="hibrido"
                                        value="1" {{ old('hibrido') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="hibrido">
                                        Híbrido
                                    </label>
                                </div>
                            </div>
                            <div class="form-group border rounded p-3">
                                <label for="local" class="fw-700"><i class="far fa-calendar-alt mr-2"></i>Período do
                                    Evento</label>
                                <div class="form-input">
                                    <label class="form-label fw-400" for="data_inicio">
                                        Inicio do Evento
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('data_inicio') is-invalid @enderror w-25"
                                        type="datetime-local" id="data_inicio" name="data_inicio"
                                        value="{{ old('data_inicio') }}">
                                    <span class="text-danger" id="msg_erro_data_inicio"></span>
                                </div>
                                <div class="form-input mt-2">
                                    <label class="form-label fw-400" for="data_fim">
                                        Fim do Evento
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('data_fim') is-invalid @enderror w-25"
                                        type="datetime-local" id="data_fim" name="data_fim"
                                        value="{{ old('data_fim') }}">
                                    <span class="text-danger" id="msg_erro_data_fim"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label fw-700" for="detalhes">Detalhes (Notas do Evento, Programação,
                                    Palestrantes): <span class="text-danger">*</span></label>
                                <div class=" @error('data_fim') border border-danger rounded p-3 @enderror">
                                    <textarea id="detalhes" name="detalhes">
                                    {{ old('detalhes') }}
                                </textarea>
                                </div>
                            </div>
                            <div class="form-group border rounded p-3">
                                <label for="inscricao" class="fw-700"><i class="far fa-edit mr-2"></i>Inscrições</label>
                                <div class="custom-control custom-switch mb-3">
                                    <input class="custom-control-input" type="checkbox" id="inscricao" name="inscricao"
                                        {{ old('inscricao') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="inscricao">
                                        Terá Inscrição?
                                    </label>
                                </div>
                                <div class="{{ old('inscricao') ? 'd-block' : 'd-none' }}" id="evento_inscricao">
                                    <div class="form-input">
                                        <label class="form-label fw-400" for="inscricao_inicio">
                                            Inscricão Inicio
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('inscricao_inicio') is-invalid @enderror w-25"
                                            type="datetime-local" id="inscricao_inicio" name="inscricao_inicio"
                                            value="{{ old('inscricao_inicio') }}">
                                        <span class="text-danger" id="msg_erro_inscricao_inicio"></span>
                                    </div>
                                    <div class="form-input mt-2">
                                        <label class="form-label fw-400" for="inscricao_fim">
                                            Inscrição Fim
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('inscricao_fim') is-invalid @enderror w-25"
                                            type="datetime-local" id="inscricao_fim" name="inscricao_fim"
                                            value="{{ old('inscricao_fim') }}">
                                        <span class="text-danger" id="msg_erro_inscricao_fim"></span>
                                    </div>
                                    <div class="form-input mt-3">
                                        <label class="form-label fw-400" for="vagas">
                                            Limite de inscritos
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control @error('vagas') is-invalid @enderror w-25"
                                            type="number" name="vagas" id="vagas" placeholder="Ilimitado"
                                            value="{{ old('vagas') }}">

                                        <div class="mt-3">
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_documento"
                                                    name="ck_documento" value="1"
                                                    {{ old('ck_documento') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_documento">
                                                    Exigir Documento (Inscrito insere um de seus documentos:
                                                    RG/CPF/Passaporte)
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_sexo"
                                                    name="ck_sexo" value="1" {{ old('ck_sexo') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_sexo">
                                                    Exigir Sexo
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="ck_identidade_genero" name="ck_identidade_genero" value="1"
                                                    {{ old('ck_identidade_genero') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_identidade_genero">
                                                    Exigir Identidade de Gênero
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_nascimento"
                                                    name="ck_nascimento" value="1"
                                                    {{ old('ck_nascimento') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_nascimento">
                                                    Exigir Data de Nascimento
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_instituicao"
                                                    name="ck_instituicao" value="1"
                                                    {{ old('ck_instituicao') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_instituicao">
                                                    Exigir Instituição de Origem
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_vinculo"
                                                    name="ck_vinculo" value="1"
                                                    {{ old('ck_vinculo') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_vinculo">
                                                    Exigir Vinculo Unicamp
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_area"
                                                    name="ck_area" value="1" {{ old('ck_area') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_area">
                                                    Exigir Área de Atuação
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_funcao"
                                                    name="ck_funcao" value="1"
                                                    {{ old('ck_funcao') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_funcao">
                                                    Exigir Função/Cargo
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_pais"
                                                    name="ck_pais" value="1" {{ old('ck_pais') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_pais">
                                                    Exigir País de Origem
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_cidade_estado"
                                                    name="ck_cidade_estado" value="1"
                                                    {{ old('ck_cidade_estado') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_cidade_estado">
                                                    Exigir Cidade/Estado
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_racial"
                                                    name="ck_racial" value="1"
                                                    {{ old('ck_racial') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_racial">
                                                    Exigir Autodeclaração Étnico Racial
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_deficiencia"
                                                    name="ck_deficiencia" value="1"
                                                    {{ old('ck_deficiencia') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_deficiencia">
                                                    Exigir Declaração de Deficiência
                                                </label>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="ck_arquivo"
                                                    name="ck_arquivo" value="1"
                                                    {{ old('ck_arquivo') ? 'checked' : '' }}>
                                                <label class="custom-control-label mb-2" for="ck_arquivo">
                                                    Exigir Arquivo de Projeto
                                                </label>
                                            </div>
                                            <div class="form-group {{ old('ck_arquivo') ? 'd-block' : 'd-none' }}"
                                                id="div_prazo_envio_arquivo">
                                                <label class="form-label fw-400" for="prazo_envio_arquivo">
                                                    Prazo para envio de arquivo
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input
                                                    class="form-control @error('prazo_envio_arquivo') is-invalid @enderror w-25"
                                                    type="datetime-local" name="prazo_envio_arquivo"
                                                    id="prazo_envio_arquivo" value="{{ old('prazo_envio_arquivo') }}">
                                                <span class="text-danger" id="msg_erro_prazo_envio_arquivo"></span>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="form-label fw-400" for="input_personalizado">
                                                    Campo Personalizado
                                                </label>
                                                <input class="form-control" type="text" name="input_personalizado"
                                                    id="input_personalizado" value="{{ old('input_personalizado') }}"
                                                    placeholder="Digite o texto do campo personalizado ...">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="form-group border rounded p-3">
                                <label for="inscricao_inicio" class="fw-700"><i
                                        class="far fa-file-certificate mr-2"></i>Certificado</label>
                                <div class="custom-control custom-switch mb-3">
                                    <input class="custom-control-input" type="checkbox" id="certificado"
                                        name="certificado" {{ old('certificado') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="certificado">
                                        Terá Certificado?
                                    </label>
                                </div>

                                <div class="{{ old('certificado') ? 'd-block' : 'd-none' }}" id="evento_certificado">
                                    <div class="custom-control custom-switch mb-3">
                                        <input class="custom-control-input" type="checkbox" id="enviar_modelo"
                                            name="enviar_modelo" {{ old('enviar_modelo') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="enviar_modelo">
                                            Enviar modelo
                                        </label>

                                    </div>
                                    <div class=" @error('modelo') border border-danger rounded p-3 @enderror mb-2">
                                        <div class="form-group {{ old('enviar_modelo') ? 'd-block' : 'd-none' }}"
                                            id="carregar_modelo">
                                            <label class="control-label font-weight-bold text-success">Upload do modelo do
                                                certificado</label>
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
                                                        @if ($errors->any())
                                                            <span class="fw-500 text-danger" style="font-size: 16px">Favor
                                                                Inclua o arquivo novamente.</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="glyphicon glyphicon-download-alt"></i>
                                                    <p class="font-weight-bold">Arraste o arquivo aqui ou clique para
                                                        selecionar.</p>
                                                    <p class="text-info fs-sm">O arquivo deve ser no formato PNG</p>
                                                </div>
                                                <input type="file" name="modelo" class="dropzone" id="modelo"
                                                    value="{{ old('modelo') }}">

                                            </div>
                                            <div id="alert-pdf-format"></div>
                                        </div>
                                    </div>
                                    <label class="form-label fw-400" for="carga_horaria">
                                        Carga Horária:
                                    </label>
                                    <input class="form-control w-25" type="number" name="carga_horaria"
                                        id="carga_horaria" placeholder="Em horas" pattern="[0-9]"
                                        value="{{ old('carga_horaria') }}">
                                    <div class="custom-control custom-switch mb-3">
                                        <input class="custom-control-input" type="checkbox" id="doc_certificado"
                                            name="doc_certificado" value="1"
                                            {{ old('doc_certificado') ? 'checked' : '' }}>
                                        <label class="custom-control-label mt-2" for="doc_certificado">
                                            Exibir número do Documento do Inscrito no Certificado
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="fal fa-check mr-1"></span> Adicionar
                            </button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
