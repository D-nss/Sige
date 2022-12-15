@extends('layouts.app')

@section('title', 'Inserir Parceiros da Ação Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Extensão</a></li>
    <li class="breadcrumb-item active">Parceiros</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_extensao->titulo}}
        <small>
            Parceiros
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
                                                    Parceiros Adicionados <span class="fw-300 color-fusion-500"></span>
                                                </h2>
                                                <div class="panel-toolbar">
                                                    <h5 class="m-0">
                                                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                                            {{count($parceiros_acao_extensao)}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    @if(count($parceiros_acao_extensao) < 1)
                                                    <div class="panel-container collapse show" style="">
                                                        <div class="panel-content">
                                                            <div class="panel-tag">
                                                                <code>Ainda não há Parceiros Inseridos.</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="frame-wrap">
                                                        <table class="table m-0">
                                                            <thead class="thead-themed">
                                                                <tr>
                                                                    <th>Parceiro</th>
                                                                    <th>Tipo</th>
                                                                    <th>Colaboracao</th>
                                                                    <th>Data/hora Adicionado em:</th>
                                                                    <th>Ação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach($parceiros_acao_extensao as $parceiro)
                                                                <tr>
                                                                    <td>
                                                                        {{$parceiro->nome}}
                                                                    </td>
                                                                    <td>
                                                                        {{$parceiro->tipo_parceiro->descricao}}
                                                                    </td>
                                                                    <td>
                                                                        {{$parceiro->colaboracao}}
                                                                    </td>
                                                                    <td>
                                                                        {{$parceiro->created_at->format('d/m/Y')}}
                                                                    </td>
                                                                    <td>
                                                                        <form method="POST" action="{{ route('acao_extensao.parceiro.destroy', $parceiro->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                                                            @csrf
                                                                            <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                                                         </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                        <div class="accordion" id="accordionParceiro">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo">
                                                                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseParceiro" aria-expanded="true" aria-controls="collapseParceiro">
                                                                        Adicionar Parceiro na Ação de Extensão
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
                                                                <div id="collapseParceiro" class="show" aria-labelledby="headingTwo" data-parent="#accordionParceiro">
                                                                    <div class="card-body">
                                                                        <form action="{{route('acao_extensao.parceiro.inserir', ['acao_extensao_id' => $acao_extensao->id])}}" id="form_acao_extensao_local" method="POST">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label" for="nome">Nome<span class="text-danger">*</span></label>
                                                                                    <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror">
                                                                                    @error('nome')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group col-md-3">
                                                                                    <label class="form-label" for="tipo_parceiro_id">Tipo <span class="text-danger">*</span></label>
                                                                                    <select class="form-control @error('tipo_parceiro_id') is-invalid @enderror" id="tipo_parceiro_id" name="tipo_parceiro_id">
                                                                                        <option value="">Selecione o Tipo</option>
                                                                                        @if (!empty($lista_tipos))
                                                                                            @foreach ($lista_tipos as $tipo)
                                                                                              <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                    @error('tipo_parceiro_id')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>

                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="form-group col-md-8">
                                                                                    <label class="form-label" for="colaboracao">Colaboracao <span class="text-danger">*</span></label>
                                                                                    <textarea id="colaboracao" name="colaboracao" class="form-control @error('colaboracao') is-invalid @enderror" rows="2"></textarea>
                                                                                    @error('colaboracao')
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
                                            @if(count($parceiros_acao_extensao) > 0)
                                            <div class="panel-container collapse show" style="">
                                                <div class="panel-content">
                                                    <div class="panel-tag">
                                                        Caso desejar <b>atualizar</b> um parceiro já inserido, <code>favor exclua </code> e insira novamente com as novas informações
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
                            Próximo passo:  <span class="fw-300"><i>Visualização Geral</i></span>
                        </h2>
                        <a href="/acoes-extensao/{{$acao_extensao->id}}/locais" class="btn btn-secondary btn-user ">
                            <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                            </span>
                            <span class="text">1. Editar Locais</span>
                        </a>
                        <a href="/acoes-extensao/{{$acao_extensao->id}}" class="btn btn-primary btn-user ">
                            <span class="icon text-white-50">
                            <i class="fal fa-arrow-right"></i>
                            </span>
                            <span class="text">Visualizar Ação</span>
                        </a>
                    </div>
                </div>
                </div>
            </div>
    </div>


@endsection
