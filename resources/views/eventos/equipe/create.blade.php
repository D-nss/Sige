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
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Equipe do Evento</span>
        <small>
        Gestão da equipe do evento {{ $evento->titulo }}
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
                                        <i class="far fa-plus icon-stack-1x opacity-100 color-success-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        Novo Membro de Equipe
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
                                        <form action="" method="post" enctype="multipart/form-data">
                                    
                                        @csrf
                                        <h3 class="font-color-light">Preencha corretamente o formulário com as informações sobre o membro da equipe nos campos correspondentes</h3>

                                        <div class="form-group mt-3">
                                            <label for="local" class="fw-500">O membro da equipe é funcionário da UNICAMP?</label>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="funcionario_unicamp" name="funcionario_unicamp" value="1">
                                                <label class="custom-control-label" for="funcionario_unicamp" id="funcionario_unicamp_label">
                                                    Não
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <label for="local" class="fw-500">O membro da equipe é aluno da UNICAMP?</label>
                                            <div class="custom-control custom-switch">
                                                <input class="custom-control-input" type="checkbox" id="aluno_unicamp" name="aluno_unicamp" value="1">
                                                <label class="custom-control-label" for="aluno_unicamp" id="aluno_unicamp_label">
                                                    Não
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group d-none" id="user_form_group">    
                                            <label class="form-label fw-500" for="simpleinput">Usuário</label>
                                            <select name="user_id" id="user_id" class="form-control w-50">
                                                <option value="">Selecione ...</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->sigla }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nome" class="fw-500">Nome Completo<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome completo" value="{{ old('nome') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cpf" class="fw-500">CPF<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite o CPF " value="{{ old('cpf') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="fw-500">E-Mail<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Digite o e-mail " value="{{ old('email') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="whatsapp" class="fw-500">Whatsapp<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Digite o e-mail " value="{{ old('whatsapp') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="instituicao" class="fw-500">Instituição Externa<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição " value="{{ old('instituicao') }}">
                                        </div>

                                        <div class="form-group">    
                                            <label class="form-label fw-500" for="simpleinput">Função no Evento<span class="text-danger">*</span></label>
                                            <select name="funcao_evento" class="form-control w-50">
                                                <option value="">Selecione ...</option>
                                                <option value="Palestrante">Palestrante</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                                        
                                        <button type="submit" class="btn btn-primary">
                                            Adicionar
                                        </button>
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
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

@endsection