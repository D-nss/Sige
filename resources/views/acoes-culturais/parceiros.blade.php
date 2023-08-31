@extends('layouts.app')

@section('title', 'Inserir Parceiros')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Cultural</a></li>
    <li class="breadcrumb-item active">Inserção de Parceiros</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_cultural->titulo}}
        <small>
            Empresas parceiras do Evento Cultural
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
                        Instituições Parceiras Adicionadas <span class="fw-300 color-fusion-500"></span>
                    </h2>
                    <div class="panel-toolbar">
                        <h5 class="m-0">
                            <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                {{count($parceiros_acao_cultural)}}
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
                                        <th>Nome</th>
                                        <th>Tipo</th>
                                        <th>Ação</th>
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

                                        <td>
                                            Remover Parceiro(a)
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="accordion" id="accordionParceiro">
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseParceiro" aria-expanded="false" aria-controls="collapseParceiro">
                                            5. (Opcional) Adicionar Instituições Parceiras com a Ação Cultural
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
                                    <div id="collapseParceiro" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionParceiro">
                                        <div class="card-body">
                                            <form action="{{route('acao_cultural.parceiro.inserir', ['acao_cultural_id' => $acao_cultural->id])}}" id="form_acao_cultura_parceiro" method="POST">
                                                @csrf
                                                <div class="row g-2">
                                                    <div class="form-group col-md-3">
                                                        <label class="form-label" for="nome">Nome da Instituição <span class="text-danger">*</span></label>
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
            <div class="card">
                <div class="card-body">
                    <a href="/acoes-culturais/{{$acao_cultural->id}}/editar" class="btn btn-secondary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                        </span>
                        <span class="text">1. Editar dados iniciais</span>
                    </a>
                    <a href="/acoes-culturais/{{$acao_cultural->id}}/datas" class="btn btn-secondary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                        </span>
                        <span class="text">2. Datas e Locais</span>
                    </a>
                    <a href="/acoes-culturais/{{$acao_cultural->id}}/coordenador" class="btn btn-secondary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                        </span>
                        <span class="text">3. Unidades e Coordenador</span>
                    </a>
                    <a href="/acoes-culturais/{{$acao_cultural->id}}/equipe" class="btn btn-secondary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-arrow-left"></i>
                        </span>
                        <span class="text">4. Equipe</span>
                    </a>
                    <a href="/acoes-culturais/{{$acao_cultural->id}}" class="btn btn-primary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-arrow-right"></i>
                        </span>
                        <span class="text">Visualizar Ação Cultural</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection