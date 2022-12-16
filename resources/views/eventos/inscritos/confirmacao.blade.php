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
                    <h3 class="fw-400 text-success">{{ $inscrito->nome }} sua inscrição está confirmada no evento!</h3>
                    <h4>Salve um print do QRCode abaixo ou clique no botão baixar</h4>
                    <h4>O acesso ao evento se dará através deste QRCode, por isso é importante apresenta-lo na portaria do evento</h4>
                    <div class="mt-3 p-3">
                        {!! $qrcode !!}
                        <div class="mt-3">
                            <a href="{{ url('inscritos/baixar_qrcode/' . $crypt) }}" class="btn btn-danger btn-md">Baixar QRCode</a> 
                        </div>
                        
                    </div>
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
            </div>
        </div>
    </div>
</div>

@endsection