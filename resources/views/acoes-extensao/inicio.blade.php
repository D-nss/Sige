@extends('layouts.app')

@section('title', 'Listagem das Ações de Extensão')

@section('content')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">Ações de Extensão</li>
        <li class="breadcrumb-item active">Início</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            Ações de Extensão - Início
        </h1>
    </div>

    <div class="bg-white mb-5 p-5 shadow">
        <div class="d-flex flex-start w-100">
            <div class="d-flex flex-fill">
                <div class="flex-fill fs-xl">
                    <p>Seja bem-vindo(a) ao módulo de <span class="fw-700">Ações de Extensão</span>. Nela os proponentes habilitados poderão formular
                        suas propostas de Ação de Extensão, disponibilizá-las para curricularização, aguardar o parecer das
                        comissões adequadas, e obter posteriormente a publicação delas.</p>
                    @if ($user->hasRole('extensao-coordenador'))
                        @if ($comissao_extensao)
                            <!-- <p>Para visualizar Comissão de Extensão cadastrada da unidade, <a href="#" data-toggle="modal" data-target="#modalComissaoExtensao">Clique aqui</a> -->
                            </p>
                            @if ($comissao_graduacao)
                                <p>Para cadastrar uma Ação de Extensão, <a href="{{ url('acoes-extensao/novo') }}">Clique aqui</a></p>
                            @else
                                <p>Sua unidade ainda não tem uma Comissão de Graduação cadastrada. Isso impossibilita aos
                                    Coordenadores das Ações de Extensão disponibilizá-las para curricularização.</p>
                                <p>Para criar a Comissao de Graduação, <a href="#" data-toggle="modal" data-target="#modalComissaoGraduacao">Clique aqui</a></p>
                            @endif
                        @else
                            <p>Sua unidade ainda não tem as comissões necessárias cadastradas.</p>
                            <p>Para criar novas comissões, <a href="#" data-toggle="modal" data-target="#modalComissaoExtensao">Clique aqui</a></p>
                        @endif
                        <p>Alternativamente, você pode visualizar e criar as Comissões de Extensão e Graduação de sua Unidade a qualquer momento selecionando <span class="fw-700">Comissões > Comissões</span> no menu principal.
                    @else
                        @if ($comissao_extensao)
                            @if ($comissao_graduacao)
                                <p>Para cadastrar uma Ação de Extensão, <a href="#">Clique aqui</a></p>
                            @else
                                <p>Sua unidade ainda não tem uma Comissão de Graduação cadastrada. Isso impossibilita aos
                                    Coordenadores das Ações de Extensão disponibilizá-las para curricularização.</p>
                                <p>Para solicitar o cadastramento desta comissão, entre em contato com o Coordenador de
                                    Extensão da sua unidade.
                                <p>
                                <p>Para cadastrar uma Ação de Extensão, <a href="#">Clique aqui</a></p>
                            @endif
                        @else
                            <p>As comissões necessárias ainda não estão cadastradas. Para solicitar o cadastramento das
                                comissões, entre em contato com o Coordenador de Extensão da sua unidade.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalComissaoExtensao" tabindex="-1" aria-labelledby="modalLabelComissaoExtensao" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelComissaoExtensao">
                        Criar Comissão de Extensão - Unidade: {{ $user->unidade->sigla }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    Cadastrar uma <span class="fw-700">Comissão de Extensão</span> é imprescindível para que as Ações de Extensão possam ser reconhecidas. O preenchimento é obrigatório.
                    </p>

                    <h3>
                        Suas Atribuições
                    </h3>

                    <p>
                    O ExteCult vai habilitar você automaticamente a revisar Ações de outros docentes da sua unidade, e a criar novas Ações de Extensão para revisão de outros integrantes da Comissão. No entanto, você não poderá ser revisor(a) de Ações de Extensão anteriormente criadas por você mesmo(a).
                    </p>
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <h3>Nome da Comissão de Extensão</h3>
                            <input type="text" name="nome_comissao" id="nome_comissao" class="form-control" placeholder="Digite aqui. Letras, números e caracteres especiais são permitidos.">
                        </div>
                        <div class="form-group">
                            <h3>Adicionar membros</h3>
                            <select name="nome_membro" id="nome_membro" class="form-control" >
                                <option value="" readonly>Selecione da lista ...</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->unidade->sigla }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span>Nomes selecionados</span>
                        <div class="border rounded p-2" style="min-height: 120px" id="nomes_selecionados">
                           
                        </div>
                        <p class="mt-3">
                            O próximo passo será a criação de uma Comissão de Graduação, que responderá às solicitações de curricularização.
                        </p>
                        <p class="alert alert-warning">
                            <i class="far fa-exclamation-circle"></i>
                            Atenção: Caso você se inclua na Comissão de Extensão, as mesmas atribuições se aplicam - você poderá criar e armazenar novas Ações no sistema, encaminhá-las para revisão de outros participantes da Comissão, e poderá revisar Ações propostas por outros Docentes da mesma Unidade, mas não poderá revisar Ações anteriormente criadas por você mesmo(a).
                        </p>
                        <div class="form-group mt-2">
                            <div class="row">
                                <div class="col">
                                <button type="button" class="btn btn-secondary" disabled id="btn-criar-comissao">
                                    <i class="far fa-check-circle"></i>
                                    Criar
                                </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col"> 
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                        <i class="far fa-times"></i>
                                        Cancelar
                                    </button>
                                </div>                            
                            </div>                            
                        </div>
                    </form>
                      

                </div>
                <!-- <div class="modal-footer">
                    
                </div> -->
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalComissaoGraduacao" tabindex="-1" aria-labelledby="modalLabelComissaoGraduacao" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelComissaoGraduacao">
                        Criar Comissão de Graduação - Unidade: {{ $user->unidade->sigla }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    Essa etapa é necessária para a disponibilização para <span class="fw-700">curricularização</span> das Ações de Extensão. Se preferir, você pode pular essa etapa e retomar o cadastro mais tarde em <span class="fw-700">Comissões > Suas Comissões</span> ou <span class="fw-700">Comissões > Cadastrar Comissão</span>
                    </p>
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <h3>Nome da Comissão de Graduação</h3>
                            <input type="text" name="nome_comissao_graduacao" id="nome_comissao_graduacao" class="form-control" placeholder="Digite aqui. Letras, números e caracteres especiais são permitidos.">
                        </div>
                        <div class="form-group">
                            <h3>Adicionar membros</h3>
                            <select name="nome_membro_graduacao" id="nome_membro_graduacao" class="form-control" >
                                <option value="">Selecione da lista ...</option>
                                @foreach($users as $us)
                                    <option value="{{ $us->id }}">{{ $us->name }} - {{ $us->unidade->sigla }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span>Nomes selecionados</span>
                        <div class="border rounded p-2" style="min-height: 120px" id="nomes_selecionados_graduacao">
                            
                        </div>
                        <div class="form-group mt-2">
                            <div class="row">
                                <div class="col d-flex flex-direction-column">
                                    <div class="form-group mr-2">
                                        <button type="button" class="btn btn-secondary" disabled id="btn-criar-comissao-graduacao">
                                            <i class="far fa-check-circle"></i>
                                            Criar
                                        </button>
                                    </div>    
                                    <div class="form-group"> 
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                                            <i class="far fa-arrow-alt-from-left"></i>
                                            Pular Esta Etapa
                                        </button>
                                    </div> 
                                </div>                   
                            </div>                       
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    
                </div> -->
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalComissoesCriadas" tabindex="-1" aria-labelledby="modalLabelComissaoCriadas" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelComissaoCriadas">
                        Comissões Criadas
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    Etapa concluída! A partir de agora, você poderá submeter novas Ações de Extensão para aprovação da sua unidade, e posterior reconhecimento pela ProEC.
                    </p>
                    
                    <p>
                    Você pode criar/cadastrar uma nova Ação de Extensão agora, ou continuar o processo mais tarde selecionando <span class="fw-700">Ações de Extensão > Cadastrar</span> no menu principal.
                    </p>

                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col">
                                <a type="button" class="btn btn-primary" href="{{ url('acoes-extensao/novo') }}">
                                    <i class="far fa-circle-notch"></i>
                                    Cadastrar Nova Ação de Extensão Agora
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col"> 
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    <i class="far fa-long-arrow-right"></i>
                                    Continuar depois
                                </button>
                            </div>                            
                        </div>                            
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    
                </div> -->
                </div>
            </form>
        </div>
    </div>
@endsection
