@extends('layouts.app')

@section('title', 'Exibição da Ação Cultural')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais"> Ações Culturais</a></li>
    <li class="breadcrumb-item active">Detalhes da Ação</li>
    <li class="breadcrumb-item"><a href="/acoes-culturais/{{$acao_cultural->id}}/editar"><button type="button" class="btn btn-xs btn-outline-primary waves-effect waves-themed">Editar
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
@if($acao_cultural->status == 'Pendente')
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-info-circle"></i>
        </div>
        <div class="flex-1">
            <span class="h5">Ação Cultural pendende de aprovação pela Comissão</span>
        </div>
        @hasanyrole('super|admin', 'web_user')
        <form action="{{ route('acao_cultural.aprovar', ['acao_cultural' => $acao_cultural->id]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Aprovar</button>
        </form>
        @endhasanyrole
        <!--a href="/acoes-extensao/{{$acao_cultural->id}}/aprovar" class="btn btn-warning btn-w-m fw-500 btn-sm"  aria-label="Close">Aprovar</a-->
    </div>
</div>
@endif
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file'></i> {{$acao_cultural->titulo}}
        <small>
            Exibição das informações desta Ação Cultural. <span class="text-muted small text-truncate"> (<strong> Cadastrado em:</strong> {{$acao_cultural->created_at->format('d/m/Y')}}. <strong> Atualizado em: </strong> {{$acao_cultural->updated_at->format('d/m/Y')}})</span>
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
                        <img src="{{asset('smartadmin-4.5.1/img/demo/avatars/avatar-m.png')}}" class="rounded-circle shadow-2 img-thumbnail" alt="{{$acao_cultural->nome_coordenador}}">
                        <h5 class="mb-0 fw-700 text-center mt-3">
                            {{$acao_cultural->nome_coordenador}}
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
                        {{$acao_cultural->vinculo_coordenador}}
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
                            {{$acao_cultural->unidade->nome}}
                            <small class="text-muted mb-0">Unidade Principal</small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 text-center">
                        {{$acao_cultural->unidade->sigla}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">
        <div class="card mb-g">
            <div class="card-body pb-0 px-4">
                <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                    <div class='icon-stack display-3 flex-shrink-0'>

                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="fal fa-theater-masks icon-stack-1x opacity-100 color-primary-500"></i>
                                    </div>
                                    <div class="ml-3">
                                    <h5 class="mb-0 flex-1 text-dark fw-500">
                                        <b>Título do Evento: </b>{{$acao_cultural->titulo}}
                        <small class="m-0 l-h-n">
                           Seguimento Cultural:
                        </small>
                    </h5>
                    <div>
                        @foreach ($segmentos_culturais as $segmento_cultural)
                            <a href="/acoes-culturais/segmento/{{$segmento_cultural}}"><span class="badge badge-danger">{{$segmento_cultural}}</span></a>
                        @endforeach
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Resumo
                            <small class="mt-0 mb-3 text-muted">
                                {{$acao_cultural->resumo}}
                            </small>
                        </h5>
                    </div>
                </div>
                @if($acao_cultural->palavras_chaves != "")
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Palavras-chaves:
                            <small class="mt-0 mb-3 text-muted">
                                    @foreach (explode(',', $acao_cultural->palavras_chaves) as $palavra_chave)
                                        <a href="/acoes-culturais/palavra-chave/{{$palavra_chave}}"><span class="badge badge-info">{{$palavra_chave}}</span></a>
                                    @endforeach

                            </small>
                        </h5>
                    </div>
                </div>
                @endif
                @if($acao_cultural->vinculo_ensino != "")
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Evento possui vinculo com ensino
                            <small class="mt-0 mb-3 text-muted">
                                <b>Título do Projeto: </b>{{$acao_cultural->vinculo_ensino}}
                            </small>
                        </h5>
                    </div>
                </div>
                @endif
                @if($acao_cultural->vinculo_pesquisa != "")
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Evento possui vinculo com pesquisa
                            <small class="mt-0 mb-3 text-muted">
                                <b>Título do Projeto: </b>{{$acao_cultural->vinculo_pesquisa}}
                            </small>
                        </h5>
                    </div>
                </div>
                @endif
                @if($acao_cultural->vinculo_extensao != "")
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Evento possui vinculo com extensão
                            <small class="mt-0 mb-3 text-muted">
                                <b>Título do Projeto: </b>{{$acao_cultural->vinculo_extensao}}
                            </small>
                        </h5>
                    </div>
                </div>
                @endif
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Público Alvo
                            <small class="mt-0 mb-3 text-muted">
                                @foreach ($selecao_publico_alvo as $publico_alvo)
                                    {{$publico_alvo}} <br>
                                @endforeach
                            </small>
                        </h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                            Link Externo
                            <small class="mt-0 mb-3 text-muted">
                                <a href="{{$acao_cultural->url}}" target="_blank" >{{$acao_cultural->url}}</a>
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
                                <a href="/acoes-culturais/cidades/{{$acao_cultural->municipio->id}}">
                                    <i class="fal fa-map-marker-alt"></i> {{$acao_cultural->municipio->nome_municipio}} - {{$acao_cultural->municipio->estado}}
                                </a>
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
                        :markers="[['lat' => $acao_cultural->municipio->latitude, 'long' => $acao_cultural->municipio->longitude, 'info' => 'teste', 'icon' => 'http://chart.apis.google.com/chart?chst=d_map_pin_icon&chld=home|1ABB9C|000000'], ['lat' => '-22.818177', 'long' => '-47.064098', 'info' => 'UNICAMP'] ]">
                    </x-maps-leaflet>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
        <!-- add : -->
        <div class="card mb-g">
            <div class="card-header bg-trans-gradient py-2 pr-2 d-flex align-items-center flex-wrap col-12">
                <div class="p-1 text-white">
                    <h2 class="mb-0 fs-xl">
                        <i class="fal fa-user-friends"></i>&nbsp
                        Informações do Evento:
                    </h2>
                </div>
            </div>
            <div class="row row-grid no-gutters">
                    <div class="col-12">
                        <a href="javascript:void(0);" class="text-center p-2 d-flex flex-column">
                            <span class="d-block text-truncate text-muted fs-xs mt-1"><b>Formato: </b>{{$acao_cultural->tipo_evento}}</span>
                        </a>
                    </div>
                <div class="col-12">
                    <div class="text-center py-3">
                        <h5 class="mb-0 fw-700">
                            Evento Gratuíto:
                            <small class="text-muted mb-0">Sim</small>
                        </h5>
                    </div>
                </div>
            </div>
        </div>


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
                        XX/XX/XXX
                        @if(isset($acao_cultural->data_fim))
                        <br>
                        <strong>
                            Data fim:
                        </strong>
                        XX/XX/XXXX
                        @endif
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
