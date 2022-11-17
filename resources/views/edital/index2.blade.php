@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos Editais</li>
    <li class="breadcrumb-item">Edital</li>
    <li class="breadcrumb-item active">Listagem Editais</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Editais</span>
        <small>
        Listagem dos editais abertos e em andamento
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
            
        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="my-3">
        @forelse($editais as $edital)
            <div class="row bg-white shadow border p-3 mb-3">
                <div class="col-sm-2 d-flex align-items-center">
                    <img src="{{ asset('storage/' . $edital->anexo_imagem )}}" class="card-img-top" alt="{{ $edital->titulo }}">
                </div>
                <div class="col-sm-3 d-flex align-items-center">
                    <p class="font-weight-bold" style="font-size: 16px;">{{ $edital->titulo }}</p>
                </div>
                <div class="col-sm-3 d-flex align-items-center">
                    <p style="font-size: 12px; color: #999;">{{ substr( $edital->resumo, 0, 350 ) . ' ... ' }}</p>
                </div>
                <div class="col-sm-4 d-flex align-items-center">
                    <div>
                        <a href='{{ asset( "storage/$edital->anexo_edital" ) }}' target="_blank" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-file-pdf"></i> Edital em PDF</a>
                        
                        @if($edital->status == 'Divulgação')
                            <a href="{{ url( 'inscricao/' . $edital->id . '/novo' ) }}" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"> <i class="far fa-arrow-alt-to-top"></i> Enviar Propostas</a>
                        @endif  
                        <!-- <a href="#" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-list-alt"></i> Classificação</a> -->
                        @if(
                             $inscricoes->filter(function($value, $key) use ($edital){
                                return data_get($value, 'edital_id') == $edital->id;
                            })->count()   
                        )
                            <a href="{{ url( 'edital/' . $edital->id . '/suas-inscricoes' ) }}" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-address-card"></i> Sua Inscrição</a>
                        @endif
                        @if( 
                            strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $edital->id)) 
                            &&
                            $comissoes->filter(function($value, $key) use ($edital){
                                return data_get($value, 'edital_id') == $edital->id;
                            })->count()
                            ||
                            $user->hasRole('edital-administrador')
                        )
                            <a href="{{ url( 'edital/' . $edital->id . '/inscricoes' ) }}" class="btn btn-warning waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-list"></i> Inscrições em Andamento</a>
                        @endif
                        {{ $user->checaAvaliadorExistenteEmEdital($edital->id, $user->id) }}
                    </div>
                </div>
            </div>
        @empty
            <div class="row bg-white shadow border p-3 mb-3">
                <h3>Não há editais</h3>
            </div>
        @endforelse

    </div>
</div>

@endsection