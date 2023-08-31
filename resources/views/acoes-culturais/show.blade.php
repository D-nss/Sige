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
        @if($userNaComissao)
        <form action="{{ route('acao_cultural.aprovar', ['acao_cultural' => $acao_cultural->id]) }}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning btn-w-m fw-500 btn-sm">Aprovar</button>
        </form>
        @endif
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
    <div class="col-xl-12">
        <div id="panel-3" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="frame-wrap w-100">
                        <div class="d-flex flex-row pb-3 pt-2  border-top-0 border-left-0 border-right-0">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                <i class="fal fa-theater-masks icon-stack-1x opacity-100 color-danger-500"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="mb-0 flex-1 text-dark fw-500">
                                    Evento Cultural
                                    <small class="m-0 l-h-n">
                                        <b>Seguimento:</b>
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
                                    Descrição da Ação:
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
                                    Formato:
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_cultural->tipo_evento}}
                                    </small>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                    Gratuito:
                                    <small class="mt-0 mb-3 text-muted">
                                        @if ($acao_cultural->gratuito)
                                        Sim
                                        @else
                                        Não
                                        @endif
                                    </small>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                    Público Alvo:
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_cultural->publico_alvo}}
                                    </small>
                                </h5>
                            </div>
                        </div>
                        @if ($acao_cultural->estimativa_publico)
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                    Estimativa Publico:
                                    <small class="mt-0 mb-3 text-muted">
                                        {{$acao_cultural->estimativa_publico}} pessoas
                                    </small>
                                </h5>
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                    Link Externo:
                                    <small class="mt-0 mb-3 text-muted">
                                        <a href="{{$acao_cultural->url}}" target="_blank">{{$acao_cultural->url}}</a>
                                    </small>
                                </h5>
                            </div>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-secondary-400"></i>
                                            <i class="fal fa-calendar-alt icon-stack-1x opacity-100 color-secondary-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Datas e Locais de Realização
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="frame-wrap">
                                            <table class="table m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Horário inicio</th>
                                                        <th>Horario final</th>
                                                        <th>Local</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($datas_acao_cultural as $data)
                                                    <tr>
                                                        <td>
                                                            {{$data->data->format('d/m/Y')}}
                                                        </td>
                                                        <td>
                                                            {{$data->hora_inicio->format('H:i')}}
                                                        </td>
                                                        <td>
                                                            {{$data->hora_fim->format('H:i')}}
                                                        </td>
                                                        <td>
                                                            {{$data->local}}
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                                            <i class="fal fa-landmark icon-stack-1x opacity-100 color-warning-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Coordenador e Unidades
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Coordenador:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_cultural->nome_coordenador}}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Email:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_cultural->email_coordenador}}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="p-0">
                                                <h5>
                                                    Vínculo com a Universidade:
                                                    <small class="mt-0 mb-3 text-muted">
                                                        {{$acao_cultural->vinculo_coordenador}}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="frame-wrap">
                                            <table class="table m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>SIGLA</th>
                                                        <th>Nome Completo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Principal
                                                        </td>
                                                        <td>
                                                            {{$acao_cultural->unidade->sigla}}
                                                        </td>
                                                        <td>
                                                            {{$acao_cultural->unidade->nome}}
                                                        </td>
                                                    </tr>
                                                    @foreach($unidades_envolvidas_acao_cultural as $unidade)
                                                    <tr>
                                                        <td>
                                                            Envolvida
                                                        </td>
                                                        <td>
                                                            {{$unidade->sigla}}
                                                        </td>
                                                        <td>
                                                            {{$unidade->nome}}
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(count($colaboradores_acao_cultural) > 0)
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                            <i class="fal fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Colaboradores (Equipe)
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="frame-wrap">
                                            <table class="table m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Nome Completo</th>
                                                        <th>Email</th>
                                                        <th>CPF</th>
                                                        <th>Vinculo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($colaboradores_acao_cultural as $colaborador)
                                                    <tr>
                                                        <td>
                                                            {{$colaborador->nome}}
                                                        </td>
                                                        <td>
                                                            {{$colaborador->email}}
                                                        </td>
                                                        <td>
                                                            {{$colaborador->cpf}}
                                                        </td>
                                                        <td>
                                                            {{$colaborador->vinculo}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(count($parceiros_acao_cultural) > 0)
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-info-400"></i>
                                            <i class="fal fa-building icon-stack-1x opacity-100 color-info-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Parceiros
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="frame-wrap">
                                            <table class="table m-0">
                                                <thead class="thead-themed">
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Tipo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($parceiros_acao_cultural as $parceiro)
                                                    <tr>
                                                        <td>
                                                            {{$parceiro->nome}}
                                                        </td>
                                                        <td>
                                                            {{$parceiro->tipo_parceiro->descricao}}
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                            <i class="fal fa-map-marked-alt icon-stack-1x opacity-100 color-success-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Cidade e Georreferenciação
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="frame-wrap">
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
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingArquivo">
                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseArquivo" aria-expanded="false" aria-controls="collapseArquivo">
                                        <div class='icon-stack display-3 flex-shrink-0'>
                                            <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                            <i class="far fa-file icon-stack-1x opacity-100 color-danger-500"></i>
                                        </div>
                                        <div class="ml-3">
                                            Arquivos
                                        </div>
                                        <span class="ml-auto">
                                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                                            </span>
                                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div id="collapseArquivo" class="collapse" aria-labelledby="headingArquivo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-6">
                                            @if($userCoordenadorAcao)
                                            <form action="{{ url('/upload-arquivo')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <h4>Uploads de Arquivos</h4>
                                                <label for="nome_arquivo" class="form-label">Nome Arquivo</label>
                                                <input type="text" class="form-control mb-2 @error('nome_arquivo') is-invalid @enderror" name="nome_arquivo" id="nome_arquivo" placeholder="Nome do arquivo" value="{{ old('nome_arquivo') }}">
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

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-wrapper @error('arquivo-anexo') border border-danger @enderror">
                                                    <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p class="font-weight-bold">Arraste o pdf do projeto aqui ou clique para selecionar.</p>

                                                    </div>
                                                    <input type="file" name="arquivo-anexo" class="dropzone" id="arquivo" value="">

                                                </div>
                                                <input type="hidden" name="modulo" value="acoes-culturais">
                                                <input type="hidden" name="referencia_id" value="{{ $acao_cultural->id }}">
                                                <button class="btn btn-success mt-3">Enviar</button>
                                            </form>
                                            @endif
                                            <div class="row border-bottom mb-2 mt-4">
                                                @foreach($arquivos as $arquivo)
                                                <div class="p-0 col-md-6">
                                                    <h5>
                                                        Nome Arquivo
                                                        <small class="mt-0 mb-3">
                                                            {{ $arquivo->nome_arquivo }}
                                                        </small>
                                                    </h5>
                                                </div>
                                                <div class="p-0 col-md-6">
                                                    <h5>
                                                        <a href='{{ url("storage/$arquivo->url_arquivo") }}' class="btn btn-xs btn-warning waves-effect waves-themed mb-1" href="#" target="_blank">Abrir Arquivo</a>
                                                        @if($userCoordenadorAcao)
                                                        <form action='{{ url("upload-arquivo/" . $arquivo->id) }}' method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                        </form>
                                                        @endif
                                                    </h5>
                                                </div>
                                                @endforeach
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
</div>


@endsection