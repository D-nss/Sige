@extends('layouts.app')

@section('title', 'Inserir Unidades e Coordenador')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Cultural</a></li>
    <li class="breadcrumb-item active">Inserção de Unidades envolvidas e Coordenador</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_cultural->titulo}}
        <small>
            Unidades e Coordenador do Evento Cultural
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
                                                    Unidades Envolvidas Adicionadas <span class="fw-300 color-fusion-500"></span>
                                                </h2>
                                                <div class="panel-toolbar">
                                                    <h5 class="m-0">
                                                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                                            {{count($unidades_envolvidas_acao_cultural)}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">

                                                    <div class="frame-wrap">
                                                        <table class="table m-0">
                                                            <thead class="thead-themed">
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>SIGLA</th>
                                                                    <th>Nome Completo</th>
                                                                    <th>Ação</th>
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
                                                                    <td>
                                                                        Alterar no formulário inicial
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
                                                                    <td>
                                                                        Remover unidade
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                        <div class="accordion" id="accordionUnidade">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo">
                                                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseUnidade" aria-expanded="false" aria-controls="collapseUnidade">
                                                                        2. (Opcional) Adicionar Unidade Envolvida com a Ação Cultural
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
                                                                <div id="collapseUnidade" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionUnidade">
                                                                    <div class="card-body">
                                                                        <form action="{{route('acao_cultural.unidades.inserir', ['acao_cultural_id' => $acao_cultural->id])}}" id="form_acao_cultura_unidades" method="POST">
                                                                            @csrf
                                                                            <div class="row g-2">
                                                                              <div class="form-group col-md-2">

                                                                                  <select class="form-control @error('unidade_id') is-invalid @enderror" id="unidade_id" name="unidade_id">
                                                                                      <option value="">Selecione a Unidade Envolvida</option>
                                                                                      @if (!empty($unidades))
                                                                                          @foreach ($unidades as $unidade)
                                                                                            <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                                                                                          @endforeach
                                                                                      @endif
                                                                                  </select>
                                                                                  @error('unidade_id')
                                                                                      <div class="invalid-feedback">
                                                                                          {{ $message }}
                                                                                      </div>
                                                                                  @enderror
                                                                              </div>
                                                                              <div class="form-group col-md-2">
                                                                                  <label class="form-label" hidden></label>
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
                                        </div>

            </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        3. Inserir Coordenador da Ação Cultural <span class="fw-300"><i>Preencha as informações nos campos especificos.</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('acao_cultural.coordenador.inserir', ['acao_cultural_id' => $acao_cultural->id])}}" id="form_acao_cultura_coordenador" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="nome_coordenador">Nome do Coordenador <span class="text-danger">*</span></label>
                                    <input type="text" id="nome_coordenador" name="nome_coordenador" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_cultural->nome_coordenador) ? $acao_cultural->nome_coordenador : old('nome_coordenador')}}">
                                    @error('nome_coordenador')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="email_coordenador">Email do Coordenador <span class="text-danger">*</span></label>
                                    <input type="text" id="email_coordenador" name="email_coordenador" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_cultural->email_coordenador) ? $acao_cultural->email_coordenador : old('email_coordenador')}}">
                                    @error('email_coordenador')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              <div class="form-group col-md-4">
                                  <label class="form-label" for="data">Vinculo do Coordenador</label>
                                  <select class="form-control @error('unidade_id') is-invalid @enderror" id="vinculo_coordenador" name="vinculo_coordenador">
                                      <option value="">Selecione o Vinculo</option>
                                      @if (!empty($lista_vinculo_coordenador))
                                          @foreach ($lista_vinculo_coordenador as $vinculo_coordenador)
                                            <option value="{{$vinculo_coordenador}}">{{$vinculo_coordenador}}</option>
                                          @endforeach
                                      @endif
                                  </select>
                                  @error('vinculo_coordenador')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group mt-3 ml-3">
                                  <a href="/acoes-culturais" class="btn btn-secondary btn-user ">
                                      <span class="icon text-white-50">
                                      <i class="fal fa-arrow-left"></i>
                                      </span>
                                      <span class="text">Voltar</span>
                                  </a>
                                  <button class="btn btn-primary" type="submit"><span class="fal fa-save mr-1"></span>Concluir Cadastro</button>
                              </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
