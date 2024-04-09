@extends('layouts.app')

@section('title', 'Cadastro de uma Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item text-primary"><a href="/acoes-extensao">Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Nova Proposta</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <img src="{{ asset('smartadmin-4.5.1/img/387.png') }}" alt="Nova Ação de Extensão Ícone">
        Nova Ação de Extensão
        <small>
            Cadastro de uma nova Ação de Extensão
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="mb-3">
                        <p>
                            A proposta de Ação será automaticamente enviada para apreciação das comissões, de acordo com a Modalidade escolhida. Quando ela estiver pronta, para enviá-la, selecione o botão ‘Enviar para Aprovação’.
                        </p>
                        <p>
                            Se for necessário, você pode salvar como rascunho e retomar a edição depois, selecionando o botão 'Salvar Rascunho'. 
                        </p>
                    </div>
                    <div class="row border-top mb-5 pt-3">
                        <div class="col-lg-5">
                            <h2>Situação Atual</h2>
                            <div class=" p-3 bg-secondary rounded" style="height: 80px">
                                <div class="row text-light justify-content-center align-items-center">
                                    <div class="d-flex justify-content-center align-items-center mr-2">
                                        <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                                            <div class="mb-2">
                                            <div class="bg-warning rounded-circle" style="width:27px; height:27px"></div>
                                            </div>
                                            
                                            <small class="text-center">Proposta</small>
                                        </div>
                                        <span class="text-warning"><i class="far fa-angle-right fa-2x"></i></span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mr-2">
                                        <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                                            <div class="bg-light rounded-circle" style="width:27px; height:27px"></div>
                                            <small class="text-center">Registro<br>Unidade</small>
                                        </div>
                                        <span class="text-light"><i class="far fa-angle-right fa-2x"></i></span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mr-2">
                                        <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                                            <div class="bg-light rounded-circle" style="width:27px; height:27px"></div>
                                            <small class="text-center">Reconheci<br>mento ProEC</small>
                                        </div>
                                        <span class="text-light"><i class="far fa-angle-right fa-2x"></i></span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mr-2">
                                        <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                                            <div class="bg-light rounded-circle" style="width:27px; height:27px"></div>
                                            <small class="text-center">Ação<br>Publicada!</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <h2>Próximos Passos</h2>
                            <div class="p-3 bg-secondary rounded d-flex justify-content-center align-items-center" style="height: 80px">
                                <p class="text-light">
                                    Após essa etapa, você poderá acompanhar a apreciação de sua proposta em <span class="fw-700"> Ações de Extensão > Minhas Ações </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @dd($comissao_graduacao)
                            @if($user->hasRole('extensao-coordenador') && $comissao_graduacao->count() <= 0)
                                <!-- coordenador mas sem comissao de graduacao -->
                                <div class="alert alert-warning">
                                    <i class="far fa-exclamation-circle"></i>
                                    A Ação não poderá ser disponibilizada para curricularização sem uma Comissão de Graduação registrada. Para habilitá-la, cadastre uma comissão em <span class="fw-700">Comissões > Cadastrar Comissão.</span>
                                </div>
                            @elseif ($comissao_graduacao->count() <= 0)
                                <!-- não coordenador mas sem comissao de graduacao -->
                                <div class="alert alert-warning">
                                    <i class="far fa-exclamation-circle"></i>
                                    A Ação não poderá ser disponibilizada para curricularização sem uma Comissão de Graduação registrada. Para habilitá-la, entre em contato com o Coordenador de Extensão da sua unidade.
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="border-top border-bottom pt-3 pb-2 mb-2">
                        <h2>Informações gerais</h2>
                    </div>
                    <small>
                        Preencha os campos correspondentes. Os campos marcados com asterisco (*) são obrigatórios.
                    </small>
                    <form class="mt-3 mb-5" action="{{route('acao_extensao.store')}}" id="form_acao_extensao" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('acoes-extensao._form')
                        <div class="row">
                            <div class="form-group mt-3 ml-3">
                                <a href="#" class="btn btn-primary ">
                                    <span class="icon text-white-50">
                                    <img src="{{ asset('smartadmin-4.5.1/img/icone_aprova.png') }}" alt="Apreciação">
                                    </span>
                                    <span class="text">Enviar para apreciação</span>
                                </a>
                                {{--<button type="submit" class="btn btn-primary btn-user btn-verde">
                                    <i class="fal fa-check"></i> <b>Criar e Adicionar Datas</b>
                                </button>--}}
                                <button class="btn btn-primary" type="submit"><span class="icon text-white-50">
                                    <img src="{{ asset('smartadmin-4.5.1/img/salvar.png') }}" alt="Apreciação">
                                    </span>
                                    <span class="text">Salvar Rascunho</span></button>
                            </div>
                          </div>
                    </form>                    
                </div>
                <div class="panel-footer border-top border-secondary">
                    <div class="row mx-2 my-5">
                        <div class="col-md-12">
                            <a href="{{ url('acoes-extensao') }}" class="btn btn-primary ">
                                <span class="icon text-white-50">
                                    <img src="{{ asset('smartadmin-4.5.1/img/381.png') }}" alt="Apreciação">
                                </span>
                                <span class="text">Minhas Ações de Extensão</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
