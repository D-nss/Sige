@extends('layouts.app')

@section('title', 'Inserir Datas da Ação Cultural')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Extensão</a></li>
    <li class="breadcrumb-item active">Locais de Realização</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_extensao->titulo}}
        <small>
            Locais de Realização
        </small>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
            <div class="col-lg-12 col-xl-12">
                                        <!--Table head-->
                                        <div id="panel" class="panel">
                                            <div class="panel-hdr bg-primary-600">
                                                <h2>
                                                    Locais Adicionados <span class="fw-300 color-fusion-500"></span>
                                                </h2>
                                                <div class="panel-toolbar">
                                                    <h5 class="m-0">
                                                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                                            {{count($locais_acao_extensao)}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    @if(count($locais_acao_extensao) < 1)
                                                    <div class="panel-container collapse show" style="">
                                                        <div class="panel-content">
                                                            <div class="panel-tag">
                                                                <code>Ainda não há Locais Inseridos.</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="frame-wrap">
                                                        <table class="table m-0">
                                                            <thead class="thead-themed">
                                                                <tr>
                                                                    <th>Local</th>
                                                                    <th>Complemento</th>
                                                                    <th>Latitude</th>
                                                                    <th>Longitude</th>
                                                                    <th>Data/hora Adicionado em:</th>
                                                                    <th>Ação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach($locais_acao_extensao as $local)
                                                                <tr>
                                                                    <td>
                                                                        {{$local->local}}
                                                                    </td>
                                                                    <td>
                                                                        {{$local->complemento}}
                                                                    </td>
                                                                    <td>
                                                                        {{$local->latitude}}
                                                                    </td>
                                                                    <td>
                                                                        {{$local->longitude}}
                                                                    </td>
                                                                    <td>
                                                                        {{$local->created_at->format('d/m/Y')}}
                                                                    </td>
                                                                    <td>
                                                                        <form method="POST" action="{{ route('acao_extensao.local.destroy', $local->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                                            @csrf
                                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                                         </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                        <div class="accordion" id="accordionLocal">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo">
                                                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseLocal" aria-expanded="true" aria-controls="collapseLocal">
                                                                        Adicionar Local de Realização da Ação de Extensão
                                                                        <span class="ml-auto">
                                                                            <span class="collapsed-reveal">
                                                                                <i class="fal fa-minus-circle text-danger"></i>
                                                                            </span>
                                                                            <span class="collapsed-hidden">
                                                                                <i class="fal fa-plus-circle text-success"></i>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div id="collapseLocal" class="show" aria-labelledby="headingTwo" data-parent="#accordionLocal">
                                                                    <div class="card-body">
                                                                        <form action="{{route('acao_extensao.local.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_local" method="POST">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label" for="local">Local<span class="text-danger">*</span></label>
                                                                                    <input type="text" id="local" name="local" class="form-control @error('local') is-invalid @enderror">
                                                                                    @error('local')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label" for="latitude">Latitude </label>
                                                                                    <input type="number" id="latitude" name="latitude" class="form-control @error('latitude') is-invalid @enderror">
                                                                                    @error('latitude')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label" for="longitude">Longitude </label>
                                                                                    <input type="number" id="longitude" name="longitude" class="form-control @error('longitude') is-invalid @enderror">
                                                                                    @error('longitude')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="form-group col-md-8">
                                                                                    <label class="form-label" for="complemento">Complemento <span class="text-danger">*</span></label>
                                                                                    <textarea id="complemento" name="complemento" class="form-control @error('complemento') is-invalid @enderror" rows="2"></textarea>
                                                                                    @error('complemento')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-4">

                                                                                    <button class="btn btn-primary" type="submit"><span class="fal fa-plus mr-1"></span>Adicionar</button>
                                                                                </div>
                                                                              </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(count($locais_acao_extensao) > 0)
                                            <div class="panel-container collapse show" style="">
                                                <div class="panel-content">
                                                    <div class="panel-tag">
                                                        Caso desejar <b>atualizar</b> um local já inserido, <code>favor exclua </code> e insira novamente com as novas informações
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h2 class="card-title">
                            Próximo passo:  <span class="fw-300"><i>Adicionar Parcerias</i></span>
                        </h2>
                        <a href="/acoes-extensao/{{$acao_extensao->id}}/editar" class="btn btn-secondary btn-user ">
                            <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                            </span>
                            <span class="text">1. Editar dados iniciais</span>
                        </a>
                        <a href="/acoes-extensao/{{$acao_extensao->id}}/parceiros" class="btn btn-primary btn-user ">
                            <span class="icon text-white-50">
                            <i class="fal fa-arrow-right"></i>
                            </span>
                            <span class="text">Adicionar Parcerias</span>
                        </a>
                    </div>
                </div>
                </div>
            </div>
    </div>


@endsection
