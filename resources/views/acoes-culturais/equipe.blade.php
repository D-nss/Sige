@extends('layouts.app')

@section('title', 'Inserir Colaboradores')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Cultural</a></li>
    <li class="breadcrumb-item active">Inserção de Colaboradores</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_cultural->titulo}}
        <small>
            Colaboradores do Evento Cultural
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
                                                            {{count($colaboradores_acao_cultural)}}
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
                                                                    <th>CPF</th>
                                                                    <th>Vinculo</th>
                                                                    <th>Ação</th>
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
                                                                    <td>
                                                                        Remover Colaborador(a)
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                        <div class="accordion" id="accordionColaborador">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo">
                                                                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseColaborador" aria-expanded="false" aria-controls="collapseColaborador">
                                                                        4. (Opcional) Adicionar Colaborador com a Ação Cultural
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
                                                                <div id="collapseColaborador" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionColaborador">
                                                                    <div class="card-body">
                                                                        <form action="{{route('acao_cultural.colaborador.inserir', ['acao_cultural_id' => $acao_cultural->id])}}" id="form_acao_cultura_equipe" method="POST">
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
                                                                                    <label class="form-label" for="cpf">CPF (Somente números)<span class="text-danger">*</span></label>
                                                                                    <input type="number" id="cpf" name="cpf" class="form-control @error('email') is-invalid @enderror">
                                                                                    @error('email')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                              <div class="form-group col-md-3">
                                                                                  <label class="form-label" for="vinculo">Vinculo <span class="text-danger">*</span></label>
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
        <div class="card">
            <div class="card-body">

                <h2 class="card-title">
                    Próximo passo:  <span class="fw-300"><i>Adicionar Parcerias</i></span>
                </h2>
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
                <a href="/acoes-culturais/{{$acao_cultural->id}}/parceiros" class="btn btn-primary btn-user ">
                    <span class="icon text-white-50">
                    <i class="fal fa-arrow-right"></i>
                    </span>
                    <span class="text">5. Parcerias</span>
                </a>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
