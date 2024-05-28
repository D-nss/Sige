@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">{{$acaoExtensaoOcorrencia->acao_extensao->titulo}}</li>
    <li class="breadcrumb-item">Gestão dos Membros</li>
    <li class="breadcrumb-item active">Novo</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Equipe da Ocorrência</span>
        <small>
        Gestão da equipe da Ocorrencia {{$acaoExtensaoOcorrencia->acao_extensao->titulo}}
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="mt-3">
                <div class="frame-wrap w-100">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                        <i class="far fa-plus icon-stack-1x opacity-100 color-success-500"></i>

                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-dark fw-500">
                                        Novo Membro de Equipe
                                    </h4>
                                    <span class="ml-auto disable">
                                        <span class="collapsed-reveal">
                                            <i class="fal fa-minus-circle text-danger"></i>
                                        </span>
                                        <span class="collapsed-hidden">
                                            <i class="fal fa-plus-circle text-success"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                        <form action="{{ url('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe') }}" method="post">
                                        @csrf
                                        @include('acoes-extensao.equipe._form')
                                        <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                                        <button type="submit" class="btn btn-primary">
                                            Adicionar
                                        </button>
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

@endsection
