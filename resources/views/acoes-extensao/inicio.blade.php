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
                            <p>Para visualizar Comissão de Extensão cadastrada da unidade, <a href="#">Clique aqui</a>
                            </p>
                            @if ($comissao_graduacao)
                                <p>Para visualizar Comissão de Graduação cadastrada da unidade, <a href="#">Clique
                                        aqui</a></p>
                            @else
                                <p>Sua unidade ainda não tem uma Comissão de Graduação cadastrada. Isso impossibilita aos
                                    Coordenadores das Ações de Extensão disponibilizá-las para curricularização.</p>
                                <p>Para criar a Comissao de Graduação, <a href="#">Clique aqui</a></p>
                            @endif
                        @else
                            <p>Sua unidade ainda não tem as comissões necessárias cadastradas.</p>
                            <p>Para criar novas comissões, <a href="#">Clique aqui</a></p>
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

@endsection
