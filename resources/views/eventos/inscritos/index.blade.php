@extends('layouts.app')

@section('title', 'Listagem dos Eventos')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Eventos</li>
    <li class="breadcrumb-item active">Gestão de Eventos</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-clipboard-list-check'></i>Inscrições de Evento</span>
        <small>
        Utilize as ferramentas abaixo para gerenciar os inscritos no evento.
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
            <h1><i class="far fa-calendar-alt fa-1x"></i> {{ $evento->titulo }}</h1>
            <h2>Link para inscrição fora do prazo: <a href="{{ url('/inscritos/novo/' . $evento->id) }}">{{ url('/inscritos/novo/' . $evento->id) }}</a></h2>
            <div class="mt-3">
                <div class="frame-wrap w-100">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
                                        <i class="far fa-users icon-stack-1x opacity-100 color-success-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-success fw-500">
                                        Inscritos Confirmados
                                    </h4>
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
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table class="table m-0 table-bordered table-sm table-hover table-striped" id="dt-inscritos-confirmados" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($confirmados as $confirmado)
                                            <tr>
                                                <td>{{ $confirmado->nome }}</td>
                                                <td>{{ $confirmado->email }}</td>
                                                <td>
                                                    <a href="{{ url('evento/inscrito/' . $confirmado->id) }}" class="btn btn-info btn-xs">
                                                        Dados Completos
                                                    </a>
                                                    
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-header" id="headingTwo">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
                                        <i class="far fa-users icon-stack-1x opacity-100 color-primary-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-primary fw-500">
                                        Inscritos Lista de Espera
                                    </h4>
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
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table class="table m-0 table-bordered table-sm table-hover table-striped" id="dt-inscritos-espera" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listaEspera as $lista)
                                            <tr>
                                                <td>{{ $lista->nome }}</td>
                                                <td>{{ $lista->email }}</td>
                                                <td>
                                                    <a href="{{ url('evento/inscrito/' . $lista->id) }}" class="btn btn-info btn-xs">
                                                        Dados Completos
                                                    </a>
                                                    <a href="" class="btn btn-warning btn-xs">
                                                        Enviar E-Mail
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-header" id="headingThree">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
                                        <i class="far fa-users icon-stack-1x opacity-100 color-warning-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-warning fw-500">
                                        Inscritos Aguardando Confirmação
                                    </h4>
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
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                <table class="table m-0 table-bordered table-sm table-hover table-striped" id="dt-inscritos-nao-confirmados" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($naoConfirmados as $naoConfirmado)
                                            <tr>
                                                <td>{{ $naoConfirmado->nome }}</td>
                                                <td>{{ $naoConfirmado->email }}</td>
                                                <td>
                                                    <a href="{{ url('evento/inscrito/' . $naoConfirmado->id) }}" class="btn btn-info btn-xs">
                                                        Dados Completos
                                                    </a>
                                                    <a href="" class="btn btn-warning btn-xs">
                                                        Enviar E-Mail
                                                    </a>
                                                    <a href="{{ url('inscritos/adm/confirmacao/' . $naoConfirmado->id) }}" class="btn btn-success btn-xs">
                                                        Confirmar
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-header" id="headingFour">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <div class='icon-stack display-3 flex-shrink-0'>
                                        <i class="fal fa-circle icon-stack-3x opacity-100 color-danger-400"></i>
                                        <i class="far fa-users icon-stack-1x opacity-100 color-danger-500"></i>
                                        
                                    </div>
                                    <h4 class="ml-2 mb-0 flex-1 text-danger fw-500">
                                        Inscritos Cancelados
                                    </h4>
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
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                <table class="table m-0 table-bordered table-sm table-hover table-striped" id="dt-inscritos-cancelados" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cancelados as $cancelado)
                                            <tr>
                                                <td>{{ $cancelado->nome }}</td>
                                                <td>{{ $cancelado->email }}</td>
                                                <td>
                                                    <a href="{{ url('evento/inscrito/' . $cancelado->id) }}" class="btn btn-info btn-xs">
                                                        Dados Completos
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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