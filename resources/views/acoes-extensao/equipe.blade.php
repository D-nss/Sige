@extends('layouts.app')

@section('title', 'Inserir Colaboradores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Extensão</a></li>
    <li class="breadcrumb-item active">Inserção de Colaboradores</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_extensao->titulo}}
        <small>
            Colaboradores da Ação de Extensão
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
                                                    Colaboradores Adicionados <span class="fw-300 color-fusion-500"></span>
                                                </h2>
                                                <div class="panel-toolbar">
                                                    <h5 class="m-0">
                                                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                                            {{count($colaboradores_acao_extensao)}}
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
                                                                    <th>Nome Completo</th>
                                                                    <th>Email</th>
                                                                    <th>Documento</th>
                                                                    <th>Nº Documento</th>
                                                                    <th>Vinculo</th>
                                                                    <th>Carga Horária</th>
                                                                    <th>Ação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th>{{$acao_extensao->nome_coordenador}}</th>
                                                                    <th>{{$acao_extensao->email_coordenador}}</th>
                                                                    <th>(Coordenador Ação)</th>
                                                                    <th>N/A</th>
                                                                    <th>{{$acao_extensao->vinculo_coordenador}}</th>
                                                                    <th>N/A</th>
                                                                    <th>-</th>
                                                                </tr>
                                                                @foreach($colaboradores_acao_extensao as $colaborador)
                                                                <tr>
                                                                    <td>
                                                                        {{$colaborador->nome}}
                                                                    </td>
                                                                    <td>
                                                                        {{$colaborador->email}}
                                                                    </td>
                                                                    <td>
                                                                        {{$colaborador->documento}}
                                                                    </td>
                                                                    <td>
                                                                        {{$colaborador->numero_doc}}
                                                                    </td>
                                                                    <td>
                                                                        {{$colaborador->vinculo}}
                                                                    </td>
                                                                    <td>
                                                                        {{$colaborador->carga_horaria}} horas
                                                                    </td>
                                                                    <td>
                                                                        <form method="POST" action="{{ route('acao_extensao.colaborador.destroy', $colaborador->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                                            @csrf
                                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                                         </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                        <div class="accordion" id="accordionColaborador">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo">
                                                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseColaborador" aria-expanded="true" aria-controls="collapseColaborador">
                                                                        Adicionar Colaborador com a Ação Extensão
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
                                                                <div id="collapseColaborador" class="show" aria-labelledby="headingTwo" data-parent="#accordionColaborador">
                                                                    <div class="card-body">
                                                                        <form action="{{route('acao_extensao.colaborador.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_equipe" method="POST">
                                                                            @csrf
                                                                            <div class="row g-4">
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="nome">Nome do Colaborador(a) <span class="text-danger">*</span></label>
                                                                                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror">
                                                                                    @error('nome')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                                                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                                                                    @error('email')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="documento">Documento</label>
                                                                                    <select class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento">
                                                                                        <option value="">Selecione o Documento</option>
                                                                                        @if (!empty($lista_documento))
                                                                                            @foreach ($lista_documento as $documento_colaborador)
                                                                                              <option value="{{$documento_colaborador}}">{{$documento_colaborador}}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                    @error('documento')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="numero_doc">Número Documento<span class="text-danger">*</span></label>
                                                                                    <input type="number" id="numero_doc" name="numero_doc" class="form-control @error('numero_doc') is-invalid @enderror">
                                                                                    @error('numero_doc')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="carga_horaria">Carga Horária<span class="text-danger">*</span></label>
                                                                                    <input type="number" id="carga_horaria" name="carga_horaria" class="form-control @error('carga_horaria') is-invalid @enderror">
                                                                                    @error('carga_horaria')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <label class="form-label" for="vinculo">Vinculo</label>
                                                                                  <select class="form-control @error('vinculo') is-invalid @enderror" id="vinculo" name="vinculo">
                                                                                      <option value="">Selecione o Vinculo</option>
                                                                                      @if (!empty($lista_vinculo))
                                                                                          @foreach ($lista_vinculo as $vinculo_colaborador)
                                                                                            <option value="{{$vinculo_colaborador}}">{{$vinculo_colaborador}}</option>
                                                                                          @endforeach
                                                                                      @endif
                                                                                  </select>
                                                                                  @error('vinculo')
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
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Equipe e Curricularização<span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('acao_extensao.curricularizacao', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="form-group col-md-2">
                                    <label class="form-label" for="vagas_curricularizacao">Vagas para Curricularização</label>
                                    <input class="form-control" id="vagas_curricularizacao" type="number" name="vagas_curricularizacao" value="{{isset($acao_extensao->vagas_curricularizacao) ? $acao_extensao->vagas_curricularizacao : old('vagas_curricularizacao')}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="grau_envolvimento_equipe_id">Tipo de envolvimento da equipe com a Comunidade <span class="text-danger">*</span></label>
                                    <select class="form-control @error('grau_envolvimento_equipe_id') is-invalid @enderror" id="grau_envolvimento_equipe_id" name="grau_envolvimento_equipe_id">
                                        @if(isset($acao_extensao->grau_envolvimento_equipe))
                                            <option value="{{$acao_extensao->grau_envolvimento_equipe->id}}">{{$acao_extensao->grau_envolvimento_equipe->descricao}}</option>
                                        @else
                                            <option value="">Selecione o Tipo</option>
                                        @endif
                                        <option value="">Selecione o tipo do envolvimento</option>
                                        @if (!empty($graus_envolvimento_equipe))
                                            @foreach ($graus_envolvimento_equipe as $grau_envolvimento_equipe)
                                              <option value="{{$grau_envolvimento_equipe->id}}">{{$grau_envolvimento_equipe->descricao}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('grau_envolvimento_equipe_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mt-3 ml-3">
                                    <button class="btn btn-primary" type="submit"><span class="icon text-white-50">
                                        <i class="fal fa-save"></i>
                                        </span>
                                        <span class="text">Salvar</span></button>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
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
                <a href="/acoes-extensao/{{$acao_extensao->id}}/locais" class="btn btn-primary btn-user ">
                    <span class="icon text-white-50">
                    <i class="fal fa-arrow-right"></i>
                    </span>
                    <span class="text">3. Locais Realização</span>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
