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
        <span class="text-success"><i class='subheader-icon fal fa-check-circle'></i>Inscrição em Evento</span>
        <small>
        Confirmação de inscrição em evento.
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>

<div class="container-fluid" id="confirm">
    <div class="row">
        <div class="col-xl-12">
            <div class="panel mt-3 p-3">
                <h1>Título Evento: <span class="font-italic fw-400 text-info">{{ $inscrito->evento->titulo }}</span></h1>
                @if($inscrito->confirmacao == 1)
                <div class="p-3 d-flex flex-row">
                    <div class="d-block flex-shrink-0">
                        {!! $qrcode !!}
                        <div class="mt-3">
                            <a href="{{ url('inscritos/baixar_qrcode/' . $crypt) }}" class="btn btn-danger btn-md">Baixar QRCode</a> 
                        </div>
                    </div>
                    <div class="d-block ml-2">
                        <span class="h6 font-weight-bold text-uppercase d-block m-0">{{ $inscrito->nome }} sua inscrição está confirmada no evento!</span>
                        <span class="fs-sm text-info h6 fw-500 mb-0 d-block">Salve um print do QRCode abaixo ou clique no botão baixar</span>
                        <span class="fs-sm text-info h6 fw-500 mb-0 d-block">O acesso ao evento se dará através deste QRCode, por isso é importante apresenta-lo na portaria do evento</span>
                    </div>
                </di>
                    
                <!-- Modal Small -->
                <div class="modal fade" id="checked-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('smartadmin-4.5.1/img/checked.gif') }}" alt="Inscrição Confirmada" class="img-fluid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
                @if( $inscrito->confirmacao == 2)
                    <h3 class="fw-400 text-danger">{{ $inscrito->nome }} sua inscrição no evento foi cancelada!</h3>
                    <!-- Modal Small -->
                    <div class="modal fade" id="checked-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('smartadmin-4.5.1/img/canceled.gif') }}" alt="Inscrição Confirmada" class="img-fluid" >
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <p>Para acompanhamento de inscrição e envio de arquivo acesse sua área clicando no botão abaixo.</p>
                <a href="{{ url('evento/inscrito/' . $inscrito->id) }}" class="btn btn-success">Área do Inscrito</a>
            </div>
        </div>
    </div>
</div>

@endsection