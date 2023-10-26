@extends('layouts.app')

@section('title', 'Formulário de Inscrição')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Eventos</li>
        <li class="breadcrumb-item active">Inscrição</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class="subheader-icon fal fa-edit"></i>Inscrição para o evento {{ $evento->titulo }} @if ($evento->gratuito)
                <span class="badge border border-primary text-primary">Gratuito</span>
            @endif
        </h1>
    </div>


    <div class="row">
        <div class="col-xl-12">
            <div class="panel mt-3 p-3">
                <div class="panel-tag">
                    Forneça seu endereço de e-mail preciso, pois usaremos esse canal para enviar o link de confirmação da
                    inscrição.
                </div>
                <form action="{{ url('evento/' . $evento->id . '/inscrito') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nome Completo<span class="text-danger">*</span></label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="Nome Completo"
                                name="nome" value="{{ old('nome') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nome Social</label><small><span class="text-small text-danger"> (Será
                                exibido no certificado se preenchido.)</span></small>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent"
                                placeholder="Caso possua um Nome Social, digite-o aqui." name="nome_social"
                                value="{{ old('nome_social') }}">
                        </div>
                        <span class="help-block">Observação: O Nome Social se destina exclusivamente às pessoas transgênero
                            e travestis. Ele será o nome a ser apresentado no certificado.</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-Mail<span class="text-danger">*</span></label>
                        <div class="input-group bg-white shadow-inset-2">
                            <input type="text" class="form-control bg-transparent" placeholder="E-Mail" name="email"
                                value="{{ old('email') }}">
                        </div>
                        <!-- <span class="help-block">Some help content goes here</span> -->
                    </div>
                    @if ($evento->ck_documento)
                        <div class="form-group">
                            <label class="form-label">Tipo Documento<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select class="form-control bg-transparent" name="tipo_documento" id="tipo_documento">
                                    @if (old('tipo_documento'))
                                        <option value="{{ old('tipo_documento') }}">{{ old('tipo_documento') }}</option>
                                    @else
                                        <option value="">Selecione ...</option>
                                    @endif
                                    <option value="CPF">CPF</option>
                                    <option value="RG">RG</option>
                                    <option value="Passaporte">Passaporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Numero do Documento<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" name="documento" id="documento" class="form-control bg-transparent"
                                    placeholder="Documento, relacionado a seleção do campo anterior"
                                    value="{{ old('documento') }}">
                            </div>
                            <span class="help-block text-danger" id="documento-alert"></span>
                        </div>
                    @endif
                    @if ($evento->ck_sexo)
                        <div class="form-group">
                            <label class="form-label">Sexo<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select class="form-control bg-transparent" name="sexo">
                                    @if (old('sexo'))
                                        <option value="{{ old('sexo') }}">{{ old('sexo') }}</option>
                                    @else
                                        <option value="">Selecione ...</option>
                                    @endif
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outro">Outro</option>
                                    <option value="Não informado">Prefiro não informar</option>
                                </select>
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_identidade_genero)
                        <div class="form-group">
                            <label class="form-label">Identidade de Genero<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select type="text" class="form-control bg-transparent" name="genero">
                                    <option value="">Selecione ...</option>
                                    <option value="Mulher" @if (old('genero') == 'Amarelo') selected @endif>Mulher</option>
                                    <option value="Homem" @if (old('genero') == 'Branco') selected @endif>Homem</option>
                                    <option value="Mulher trans" @if (old('genero') == 'Mulher trans') selected @endif>Mulher
                                        trans</option>
                                    <option value="Homem trans" @if (old('genero') == 'Homem trans') selected @endif>Homem
                                        trans</option>
                                    <option value="Não binário " @if (old('genero') == 'Não binário') selected @endif>Não
                                        binário</option>
                                </select>
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_nascimento)
                        <div class="form-group">
                            <label class="form-label">Nascimento<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="date" class="form-control bg-transparent" placeholder="Nascimento"
                                    name="nascimento" value="{{ old('nascimento') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_cidade_estado)
                        <div class="form-group">
                            <label class="form-label">Cidade/ Estado<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent" placeholder="Cidade/ Estado"
                                    name="municipio" value="{{ old('municipio') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_pais)
                        <div class="form-group">
                            <label class="form-label">Pais<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent" placeholder="Pais"
                                    name="pais" value="{{ old('pais') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_area)
                        <div class="form-group">
                            <label class="form-label">Área de Atuação<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent" placeholder="Área de Atuação"
                                    name="area" value="{{ old('area') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_funcao)
                        <div class="form-group">
                            <label class="form-label">Função<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent" placeholder="Função"
                                    name="funcao" value="{{ old('funcao') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_instituicao)
                        <div class="form-group">
                            <label class="form-label">Instituição<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent" placeholder="Instituição"
                                    name="instituicao" value="{{ old('instituicao') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_vinculo)
                        <div class="form-group">
                            <label class="form-label">Vinculo com a Unicamp<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select type="text" class="form-control bg-transparent" name="vinculo">
                                    <option value="">Selecione ...</option>
                                    <option value="Docente" @if (old('vinculo') == 'Docente') selected @endif>Docente
                                    </option>
                                    <option value="Funcionário Unicamp" @if (old('vinculo') == 'Funcionário Unicamp') selected @endif>
                                        Funcionário Unicamp</option>
                                    <option value="Funcionário Funcamp" @if (old('vinculo') == 'Funcionário Funcamp') selected @endif>
                                        Funcionário Funcamp</option>
                                    <option value="Terceirizado" @if (old('vinculo') == 'Terceirizado') selected @endif>
                                        Terceirizado</option>
                                    <option value="Estagiário" @if (old('vinculo') == 'Estagiário') selected @endif>
                                        Estagiário</option>
                                    <option value="Discente de pós-graduação"
                                        @if (old('vinculo') == 'Discente de pós-graduação') selected @endif>Discente de pós-graduação
                                    </option>
                                    <option value="Discente de graduação"
                                        @if (old('vinculo') == 'Discente de graduação') selected @endif>Discente de graduação</option>
                                    <option value="Aluno de cursos e projetos"
                                        @if (old('vinculo') == 'Aluno de cursos e projetos') selected @endif>Aluno de cursos e projetos
                                    </option>
                                    <option value="Sem vínculo" @if (old('vinculo') == 'Sem vínculo') selected @endif>Sem
                                        vínculo</option>
                                </select>
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_racial)
                        <div class="form-group">
                            <label class="form-label">Autodeclaração Étnico Racial<span
                                    class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select type="text" class="form-control bg-transparent" name="etnico_racial">
                                    <option value="">Selecione ...</option>
                                    <option value="Amarelo" @if (old('etnico_racial') == 'Amarelo') selected @endif>Amarelo
                                    </option>
                                    <option value="Branco" @if (old('etnico_racial') == 'Branco') selected @endif>Branco
                                    </option>
                                    <option value="Indígena" @if (old('etnico_racial') == 'Indígena') selected @endif>Indígena
                                    </option>
                                    <option value="Pardo" @if (old('etnico_racial') == 'Pardo') selected @endif>Pardo
                                    </option>
                                    <option value="Preto" @if (old('etnico_racial') == 'Preto') selected @endif>Preto
                                    </option>
                                </select>
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if ($evento->ck_racial)
                        <div class="form-group">
                            <label class="form-label">Possui Alguma Deficiência<span class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <select type="text" class="form-control bg-transparent" name="deficiencia"
                                    id="deficiencia" value="{{ old('deficiencia') }}">
                                    <option value="">Selecione ...</option>
                                    <option value="Sim" @if (old('deficiencia') == 'Sim') selected @endif>Sim</option>
                                    <option value="Não" @if (old('deficiencia') == 'Não') selected @endif>Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group @if (old('deficiencia') == 'Sim') d-block @else d-none @endif"
                            id="div_desc_deficiencia">
                            <label class="form-label">Descrição da Deficiência<span class="text-danger">*</span></label>
                            <textarea class="form-control bg-transparent" name="desc_deficiencia" cols="30" rows="3"
                                placeholder="Descreva a sua deficiência">{{ old('desc_deficiencia') }}</textarea>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif
                    @if (isset($evento->input_personalizado))
                        <div class="form-group">
                            <label class="form-label">{{ $evento->input_personalizado }}<span
                                    class="text-danger">*</span></label>
                            <div class="input-group bg-white shadow-inset-2">
                                <input type="text" class="form-control bg-transparent"
                                    placeholder="Insira a informação" name="personalizado"
                                    value="{{ old('personalizado') }}">
                            </div>
                            <!-- <span class="help-block">Some help content goes here</span> -->
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        <span class="fal fa-calendar-check mr-1"></span> Cadastrar
                    </button>
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>

                </form>
            </div>
        </div>
    </div>


@endsection
