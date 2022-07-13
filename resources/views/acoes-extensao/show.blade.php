@extends('layouts.app')

@section('title', 'Exibição da Ação de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-extensao"> Ações de Extensão</a></li>
    <li class="breadcrumb-item active">Detalhes da Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-extensao/{{$acao_extensao->id}}/editar"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Editar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> {{$acao_extensao->titulo}}
        @switch($acao_extensao->situacao)
                                        @case(1)
                                        <span class="badge badge-danger">Desativado</span>
                                            @break
                                        @case(2)
                                            <span class="badge badge-info">Em Andamento</span>
                                            @break
                                        @case(3)
                                            <span class="badge badge-success">Concluído</span>
                                            @break
                                        @default
                                        <span class="badge badge-warning">Indefinido</span>
        @endswitch
        <small>
            Exibição das informações desta Ação de Extensão. <span class="text-muted small text-truncate"> (<strong> Cadastrado em:</strong> {{$acao_extensao->created_at->format('d/m/Y')}}. <strong> Atualizado em: </strong> {{$acao_extensao->updated_at->format('d/m/Y')}})</span>
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
        <!-- profile summary -->
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <img src="{{asset('smartadmin-4.5.1/img/demo/avatars/avatar-m.png')}}" class="rounded-circle shadow-2 img-thumbnail" alt="{{$acao_extensao->nome_coordenador}}">
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            {{$acao_extensao->nome_coordenador}}
                            <small class="text-muted mb-0">Coordenador(a)</small>
                        </h5>
                        <!--div class="mt-4 text-center demo">
                            <a href="javascript:void(0);" class="fs-xl" style="color:#3b5998">
                                <img src="{{asset('smartadmin-4.5.1/img/lattes_logo.png')}}" alt="">
                            </a>
                        </div-->
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        @switch($acao_extensao->tipo_coordenador)
                                @case(1)
                                    Docente
                                    @break
                                @case(2)
                                    Discente
                                    @break
                                @case(3)
                                    Técnico Administrativo
                                    @break
                                @case(4)
                                    Outro
                                    @break
                                @default
                            @endswitch
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                            <i class="fal fa-landmark icon-stack-1x opacity-100 color-warning-500"></i>
                        </div>
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            {{$acao_extensao->unidade->nome}}
                            <small class="text-muted mb-0">Unidade Responsável</small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        {{$acao_extensao->unidade->sigla}}
                    </div>
                </div>
            </div>
        </div>
        <!-- photos
        <div class="card mb-g">
            <div class="row row-grid no-gutters">
                <div class="col-12">
                    <div class="p-3">
                        <h2 class="mb-0 fs-xl">
                            Photos
                        </h2>
                    </div>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/1.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/2.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/3.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/4.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/5.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/6.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/7.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/8.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-4">
                    <a href="javascript:void(0);" class="text-center px-3 py-4 d-flex position-relative height-10 border">
                        <span class="position-absolute pos-top pos-left pos-right pos-bottom" style="background-image: url('img/demo/gallery/thumb/9.jpg');background-size: cover;"></span>
                    </a>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        <a href="javascript:void(0);" class="btn-link font-weight-bold">View all</a>
                    </div>
                </div>
            </div>
        </div -->

        <div class="card mb-g">
            <div class="row row-grid no-gutters">
                <div class="col-12">
                    <div class="card-header p-3 text-white bg-trans-gradient py-2 pr-2 d-flex align-items-center flex-wrap col-12">
                        <h2 class="mb-0 fs-xl">
                            <i class="fal fa-users"></i>&nbsp
                            Equipe
                        </h2>
                    </div>
                </div>
                @if($acao_extensao->equipe != "")
                    @foreach (explode(',',$acao_extensao->equipe) as $colaborador)
                        <div class="col-4">
                            <a href="javascript:void(0);" class="text-center p-3 d-flex flex-column hover-highlight" data-toggle="tooltip" data-placement="auto" title="" data-original-title="{{$colaborador}}">
                                <span class="profile-image rounded-circle d-block m-auto" style="background-image:url('{{asset('smartadmin-4.5.1/img/demo/avatars/avatar-m.png')}}'); background-size: cover;"></span>
                                <span class="d-block text-truncate text-muted fs-xs mt-1">{{$colaborador}}</span>
                            </a>
                        </div>
                    @endforeach
                @endif
                <div class="col-12">
                </div>
                @if(isset($acao_extensao->qtd_graduacao))
                <div class="col-6">
                    <div class="text-center py-3">
                        <h5 class="mb-0 fw-700">
                            {{$acao_extensao->qtd_graduacao}}
                            <small class="text-muted mb-0">Graduação</small>
                        </h5>
                    </div>
                </div>
                @endif
                @if(isset($acao_extensao->qtd_pos_graduacao))
                <div class="col-6">
                    <div class="text-center py-3">
                        <h5 class="mb-0 fw-700">
                            {{$acao_extensao->qtd_pos_graduacao}}
                            <small class="text-muted mb-0">Pós-Graduação</small>
                        </h5>
                    </div>
                </div>
                @endif

                <div class="col-12">
                    <div class="text-center p-2">
                        <h5 class="mb-0 fw-700">
                            Envolvimento com a Comunidade:
                            <small class="text-muted mb-0">{{$acao_extensao->grau_envolvimento_equipe->descricao}}</small>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">
        <!-- div class="card border mb-g">
            <div class="card-body pl-4 pt-4 pr-4 pb-0">
                <div class="d-flex flex-column">
                    <div class="border-0 flex-1 position-relative shadow-top">
                        <div class="pt-2 pb-1 pr-0 pl-0 rounded-0 position-relative" tabindex="-1">
                            <span class="profile-image rounded-circle d-block position-absolute" style="background-image:url('img/demo/avatars/avatar-admin.png'); background-size: cover;"></span>
                            <div class="pl-5 ml-5">
                                <textarea class="form-control border-0 p-0 fs-xl bg-transparent" rows="4" placeholder="What's on your mind Codex?..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="height-8 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
                            <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
                            <i class="fal fa-paperclip color-fusion-300"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
                            <i class="fal fa-camera color-fusion-300"></i>
                        </a>
                        <button class="btn btn-info shadow-0 ml-auto">Post</button>
                    </div>
                </div>
            </div>
        </div -->
        <!-- post comment -->
        <!--div class="card mb-2">
            <div class="card-body">
                <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                    <div class='icon-stack display-3 flex-shrink-0'-->

        <div class="card mb-g">
            <div class="card-body pb-0 px-4">
                <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                    <div class='icon-stack display-3 flex-shrink-0'>
                        @switch($acao_extensao->tipo)
                                @case(1)
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-inbox icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                    <h5 class="mb-0 flex-1 text-dark fw-500">
                                        Programa
                                    @break
                                @case(2)
                                    <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                            <i class="fal fa-inbox icon-stack-1x opacity-100 color-primary-500"></i>
                                        </div>
                                        <div class="ml-3">
                                        <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Projeto
                                    @break
                                @case(3)
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-inbox icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                    <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Curso
                                    @break
                                @case(4)
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-newspaper icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                    <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Evento
                                    @break
                                @case(5)
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-inbox icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                    <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Prestação de Serviços
                                    @break
                                @default
                        @endswitch
                        <small class="m-0 l-h-n">
                            {{$acao_extensao->linha_extensao->nome}}
                        </small>
                    </h5>
                    <div>
                    @if($acao_extensao->palavras_chaves != "")
                        @foreach (explode(',', $acao_extensao->palavras_chaves) as $palavra_chave)
                            <a href="#"><span class="badge badge-info">{{$palavra_chave}}</span></a>
                        @endforeach
                    @endif
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Descrição da Ação
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->descricao}}
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Público Alvo
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->publico_alvo}}
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Link Externo
                            <small class="mt-0 mb-3 text-muted">
                                <a href="{{$acao_extensao->url}}" target="_blank" >{{$acao_extensao->url}}</a>
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Impactos para a Universidade
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->impactos_universidade}}
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Impactos para a Sociedade
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_extensao->impactos_sociedade}}
                            </small>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-g">
            <div class="card-body pb-0 px-4">
                <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                    <div class='icon-stack display-3 flex-shrink-0'>
                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                        <i class="fal fa-map-marked-alt icon-stack-1x opacity-100 color-primary-500"></i>
                    </div>
                    <div class="ml-3">
                    <h5 class="mb-0 flex-1 text-dark fw-500">
                        Cidade e Georreferenciação
                        <small class="m-0 l-h-n">
                            Localização dos pontos onde esta ação está sendo executada
                        </small>
                    </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            <i class="fal fa-map-marker-alt"></i> {{$acao_extensao->municipio->nome_municipio}} - {{$acao_extensao->municipio->estado}}
                            <small>
                                Cidade - Estado
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="pb-3 pt-2 border-top-0 border-left-0 border-right-0 text-muted">
                    <x-maps-leaflet
                        :centerPoint="['lat' => -22.195240, 'long' => -48.433408]"
                        :zoomLevel="7"
                        :markers="[['lat' => $acao_extensao->municipio->latitude, 'long' => $acao_extensao->municipio->longitude, 'info' => 'teste', 'icon' => 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|1ABB9C|000000'], ['lat' => '-22.818177', 'long' => '-47.064098', 'info' => 'UNICAMP'] ]">
                    </x-maps-leaflet>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
        <!-- add : -->
        @foreach ($acao_extensao->areas_tematicas as $area_tematica)
        <div class="card mb-2">
            @switch($area_tematica->id)
                @case(1) <!-- Comunicação -->
                    <div class="card bg-danger-900 text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 white"></i>
                                <i class="fal fa-megaphone icon-stack-1x opacity-100 white"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>

                    @break
                @case(2) <!-- Cultura -->
                    <div class="card bg-danger-50 text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center color-fusion-900">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-fusion-900"></i>
                                <i class="fal fa-theater-masks icon-stack-1x opacity-100 color-fusion-900"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>

                    @break
                @case(3) <!-- Direitos Humanos... -->
                    <div class="card bg-warning-50 color-fusion-900 text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center color-fusion-900">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-fusion-900"></i>
                                <i class="fal fa-balance-scale icon-stack-1x opacity-100 color-fusion-900"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>

                    @break

                @case(4)  <!-- Educação -->
                    <div class="card bg-warning-900 text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 white"></i>
                                <i class="fal fa-graduation-cap icon-stack-1x opacity-100 white"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>
                    @break
                @case(5)  <!-- Meio Ambiente -->
                    <div class="card bg-success text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 white"></i>
                                <i class="fal fa-leaf icon-stack-1x opacity-100 white"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>
                    @break
                @case(6)  <!-- Saúde -->
                    <div class="card bg-light color-fusion-900 text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center color-fusion-900">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-fusion-900"></i>
                                <i class="fal fa-heartbeat icon-stack-1x opacity-100 color-fusion-900"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>
                    @break
                @case(7)  <!-- Tecnologia... -->
                    <div class="card bg-primary text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100"></i>
                                <i class="fal fa-cubes icon-stack-1x opacity-100"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>
                    @break
                @case(8)  <!-- Trabalho -->
                    <div class="card bg-fusion-900 text-white text-center p-3">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 white"></i>
                                <i class="fal fa-briefcase icon-stack-1x opacity-100 white"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    {{$area_tematica->nome}}
                                </strong>
                                <br>
                                Área Temática
                            </div>
                        </a>
                    </div>
                    @break

                @default
                <div class="card bg-warning-900 text-white text-center p-3">
                    <a href="javascript:void(0);" class="d-flex flex-row align-items-center text-white">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 white"></i>
                            <i class="fal fa-book-reader icon-stack-1x opacity-100 white"></i>
                        </div>
                        <div class="ml-3">
                            <strong>
                                {{$area_tematica->nome}}
                            </strong>
                            <br>
                            Área Temática
                        </div>
                    </a>
                </div>


            @endswitch
        </div>
        @endforeach

        <div class="card mb-2">
            <div class="card-body">
                <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                    <div class='icon-stack display-3 flex-shrink-0'>
                        <i class="fal fa-circle icon-stack-3x opacity-100 "></i>
                        <i class="fal fa-calendar-alt icon-stack-1x opacity-100 "></i>
                    </div>
                    <div class="ml-3">
                        <strong>
                            Data inicio:
                        </strong>
                        {{$acao_extensao->data_inicio}}
                        <br>
                        <strong>
                            Data fim:
                        </strong>
                        {{$acao_extensao->data_fim}}
                    </div>
                </a>
            </div>
        </div>

        @if(isset($acao_extensao->parceiro))
        <div class="card mb-g">
            <div class="card-header bg-trans-gradient py-2 pr-2 d-flex align-items-center flex-wrap col-12">
                <div class="p-1 text-white">
                    <h2 class="mb-0 fs-xl">
                        <i class="fal fa-user-friends"></i>&nbsp
                        Parceiro(s)
                    </h2>
                </div>
            </div>
            <div class="row row-grid no-gutters">
                @foreach (explode(',',$acao_extensao->parceiro) as $parceiro)
                    <div class="col-12">
                        <a href="javascript:void(0);" class="text-center p-2 d-flex flex-column">
                            <span class="d-block text-truncate text-muted fs-xs mt-1">{{$parceiro}}</span>
                        </a>
                    </div>
                @endforeach
                <div class="col-12">
                    <div class="text-center py-3">
                        <h5 class="mb-0 fw-700">
                            Tipo do principal Parceiro:
                            <small class="text-muted mb-0">{{$acao_extensao->tipo_parceiro->descricao}}</small>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
