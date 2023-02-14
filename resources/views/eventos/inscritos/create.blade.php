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
        <span class="text-success"><i class='subheader-icon fal fa-user-plus'></i>Inscrição em Evento</span>
        <small>
        Utilize o formulário abaixo para se inscrever no evento.
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
            <div class="panel mt-3 p-3">
                <<div class="flex-1">
                    <span class="f-lg font-color-light">Título do Evento</span>
                    <h1 class="font-italic fw-300 text-info">{{ $inscrito->evento->titulo }}</h1>
                </div>
                <span class="f-lg fw-500 font-color-light">Dados da Inscrição</span>
                <form action="{{ url('evento/' . $evento->id .'/inscrito') }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nome Completo</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Nome Completo" name="nome">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-Mail</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="E-Mail" name="email">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @if($evento->ck_documento)
                    <div class="form-group">
                        <label class="form-label">Tipo Documento</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <select class="form-control bg-transparent"  name="tipo_documento">
                                <option value="">Selecione ...</option>
                                <option value="cpf">CPF</option>
                                <option value="rg">RG</option>
                                <option value="passaporte">Passaporte</option>
                            </select>
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    <div class="form-group">
                        <label class="form-label">Numero Documento</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Documento" name="documento">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_sexo)
                    <div class="form-group">
                        <label class="form-label">Sexo</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Sexo" name="sexo">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_identidade_genero)
                    <div class="form-group">
                        <label class="form-label">Identidade de Genero</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Identidade de Genero" name="genero">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_nascimento)
                    <div class="form-group">
                        <label class="form-label">Nascimento</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="date" class="form-control bg-transparent" placeholder="Nascimento" name="nascimento">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_cidade_estado)
                    <div class="form-group">
                        <label class="form-label">Cidade/ Estado</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Cidade/ Estado" name="municipios">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_pais)
                    <div class="form-group">
                        <label class="form-label">Pais</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Pais" name="pais">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_area)
                    <div class="form-group">
                        <label class="form-label">Área de Atuação</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Área de Atuação" name="area">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_funcao)
                    <div class="form-group">
                        <label class="form-label">Função</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Função" name="funcao">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_instituicao)
                    <div class="form-group">
                        <label class="form-label">Instituição</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Instituição" name="instituicao">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif
                    @if($evento->ck_vinculo)
                    <div class="form-group">
                        <label class="form-label">Vinculo com a Unicamp</label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Vinculo com a Unicamp" name="vinculo">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection