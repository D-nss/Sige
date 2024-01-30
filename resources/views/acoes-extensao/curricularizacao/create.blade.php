@extends('layouts.app')

@section('title', 'Listagem Curricularização das Ações de Extensão')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">BAEC</li>
    <li class="breadcrumb-item active">Cadastro Curricularização das Ações de Extensão</li>
    </button></a></li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-list'></i> Ações de Extensão
        <small>
            Cadastro para curricularizações de Ação de Extensão
        </small>
    </h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Confirme as informações para se inscrever na curricularização da ação de extenção:<span class="ml-2 text-success"> {{ $acao_extensao_ocorrencia->acao_extensao->titulo }}</stan>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                  <form action='{{ url("/acoes-extensao-ocorrencia/$acao_extensao_ocorrencia->id/curricularizacao/store") }}' method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="ra">Registro do Aluno (RA)</label>
                        <input type="text" class="form-control w-25" placeholder="Digite seu RA" name="ra" id="ra" value="{{ $dadosAluno[0]->NREGALUN }}" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="malucompl" class="form-label">Nome Aluno</label>
                        <input type="text" class="form-control w-50" id="malucompl" value="{{ $dadosAluno[0]->MALUCOMPL }}" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="dnascalu" class="form-label">Data Nascimento</label>
                        <input type="text" class="form-control w-25" id="dnascalu" value="{{ $dadosAluno[0]->DNASCALU}}"  readonly>
                    </div>
                    <div class="form-group ">
                        <label for="munidensi" class="form-label">Faculdade ou Instituto</label>
                        <input type="text" class="form-control w-50" id="munidensi" name="munidensi" value="{{ $dadosAluno[0]->MUNIDENSI }}" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="nivform" class="form-label">Nível Formação</label>
                        <input type="text" class="form-control w-25" id="nivform" value="{{ $dadosAluno[0]->NIVFORM }}" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="nivform" class="form-label">Carta Apresentação</label>
                        <textarea class="form-control w-25" name="carta_apresentacao" id="carta_apresentacao"></textarea>
                    </div>

                    <button class="btn btn-primary">Inscrever</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
