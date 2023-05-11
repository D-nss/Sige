@extends('layouts.app')

@section('title', 'Inserir Datas da Ação Cultural')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/acoes-culturais">BAEC</a></li>
    <li class="breadcrumb-item">Ação Cultural</a></li>
    <li class="breadcrumb-item active">Inserção de Datas</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-file-plus'></i> {{$acao_cultural->titulo}}
        <small>
            Datas e locais do Evento Cultural
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
                                                    Datas e Locais do Evento Adicionadas <span class="fw-300 color-fusion-500"></span>
                                                </h2>
                                                <div class="panel-toolbar">
                                                    <h5 class="m-0">
                                                        <span class="badge badge-pill badge-secondary fw-400 l-h-n">
                                                            {{count($datas_acao_cultural)}}
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    @if(count($datas_acao_cultural) < 1)
                                                    <div class="panel-container collapse show" style="">
                                                        <div class="panel-content">
                                                            <div class="panel-tag">
                                                                <code>Ainda o Evento não há Datas Inseridas.</code>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="frame-wrap">
                                                        <table class="table m-0">
                                                            <thead class="thead-themed">
                                                                <tr>
                                                                    <th>Data</th>
                                                                    <th>Horário inicio</th>
                                                                    <th>Horario final</th>
                                                                    <th>Local</th>
                                                                    <th>Data/hora Adicionado em:</th>
                                                                    <th>Ação</th>
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
                                                                    <td>
                                                                        {{$data->created_at->format('d/m/Y')}}
                                                                    </td>
                                                                    <td>
                                                                        Remover data
                                                                    </td>
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(count($datas_acao_cultural) > 0)
                                            <div class="panel-container collapse show" style="">
                                                <div class="panel-content">
                                                    <div class="panel-tag">
                                                        Caso desejar <b>atualizar</b> uma data já inserida, <code>favor exclua </code> e insira novamente com as novas informações
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
            </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
          <div id="panel-1" class="panel">
              <div class="panel-hdr">
                  <h2>
                      2. Adição de Datas e Locais do Evento <span class="fw-300"><i>Insira as informações nos campos correspondentes</i></span>
                  </h2>
              </div>
              <div class="panel-container show">
                  <div class="panel-content">
                      <form action="{{route('acao_cultural.datas.inserir', ['acao_cultural_id' => $acao_cultural->id])}}" id="form_acao_cultura_datas" method="POST">
                          @csrf
                          <div class="row g-5">
                            <div class="form-group col-md-2">
                                <label class="form-label" for="data">Data<span class="text-danger">*</span></label>
                                <input class="form-control @error('data') is-invalid @enderror" type="date" id="data" name="data" placeholder="dd/mm/aaaa" value="">
                                @error('data')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="hora_inicio">Horário inicial</label>
                                <input class="form-control" type="time" value="" id="hora_inicio" name="hora_inicio">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="hora_fim">Horário final</label>
                                <input class="form-control" type="time" value="" id="hora_fim" name="hora_fim">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="local">Local<span class="text-danger">*</span></label>
                                <input type="text" id="local" name="local"  class="form-control @error('local') is-invalid @enderror">
                                @error('local')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label"></label>
                                <button class="btn btn-primary" type="submit"><span class="fal fa-plus mr-1"></span>Adicionar</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group mt-3 ml-3">
                                <a href="/acoes-culturais/{{$acao_cultural->id}}/editar" class="btn btn-secondary btn-user ">
                                    <span class="icon text-white-50">
                                    <i class="fal fa-arrow-left"></i>
                                    </span>
                                    <span class="text">1. Editar dados iniciais</span>
                                </a>
                                <a href="/acoes-culturais/{{$acao_cultural->id}}/coordenador" class="btn btn-primary">
                                    <span class="icon text-white-50">
                                    <i class="fal fa-arrow-alt-right"></i>
                                    </span>
                                    <span class="text">3. Unidades e Coordenador</span>
                                </a>
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
