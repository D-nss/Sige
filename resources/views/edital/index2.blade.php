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
        <div class="accordion" id="accordion">
        @forelse($editais as $edital)
            <div class="card mb-2">
                <div class="card-header bg-white" id="headingEdital{{$edital->id}}">
                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#collapseEdital{{$edital->id}}" aria-expanded="false" aria-controls="collapseEdital{{$edital->id}}">
                        <span class="mr-auto">
                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                <!-- <i class="fal fa-circle icon-stack-2x opacity-40"></i> -->
                                <i class="far fa-chevron-up icon-stack-2x opacity-100 color-primary-500"></i>
                            </span>
                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                <!-- <i class="fal fa-circle icon-stack-2x opacity-40"></i> -->
                                <i class="far fa-chevron-down icon-stack-2x opacity-100 color-primary-500"></i>
                            </span>
                        </span>    
                        <div class='icon-stack display-3 flex-shrink-0 ml-4'>       
                            <i class="fal fa-square icon-stack-3x opacity-100 color-primary-500"></i>
                            <i class="far fa-clipboard-list-check icon-stack-2x color-primary-500"></i>
                        </div>
                        <h4 class="ml-2 mb-0 flex-1 text-primary fw-700 fs-xl color-white-100" >
                            {{ $edital->titulo}}
                        </h4>
                        <span class="ml-auto">
                            <span class="text-muted text-italic fs-sm">Data de Divulgação: {{ date('d/m/Y', strtotime($cronograma->getDate('dt_divulgacao', $edital->id))) }}</span>
                        </span>
                    </a>
                </div>
                <div id="collapseEdital{{$edital->id}}" class="collapse" aria-labelledby="headingEdital{{$edital->id}}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="panel">
                                <div class="panel-hdr bg-primary-300">
                                    <h4>
                                        Resumo
                                    </h4>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src='{{ !!$edital->anexo_imagem ? asset("storage/$edital->anexo_imagem" ) : asset("/smartadmin-4.5.1/img/logo_proec_completo.png") }}' class="card-img-top" alt="{{ $edital->titulo }}">
                                            </div>
                                            <div class="col-10 text-justify">
                                                {{ $edital->resumo }}
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <a href='{{ asset( "storage/$edital->anexo_edital" ) }}' target="_blank" class="btn btn-outline-primary btn-pills waves-effect waves-themed  my-1 font-weight-bold"><i class="far fa-file-pdf"></i> Edital em PDF</a>
                                            
                                            @if($edital->status == 'Divulgação')
                                                <a href="{{ url( 'inscricao/' . $edital->id . '/novo' ) }}" class="btn btn-primary btn-pills waves-effect waves-themed my-1 font-weight-bold"> <i class="far fa-arrow-alt-to-top"></i> Enviar Propostas</a>
                                            @endif   
                                            @if(
                                                $inscricoes->filter(function($value, $key) use ($edital){
                                                    return data_get($value, 'edital_id') == $edital->id;
                                                })->count()   
                                            )
                                                <a href="{{ url( 'edital/' . $edital->id . '/suas-inscricoes' ) }}" class="btn btn-outline-primary btn-pills waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-address-card"></i> Sua Inscrição</a>
                                            @endif
                    
                                            @if( 
                                                (
                                                    strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $edital->id)) 
                                                    &&
                                                    ( $comissoes->filter(function($value, $key) use ($edital){
                                                            return data_get($value, 'edital_id') == $edital->id;
                                                        })->count()                                    
                                                        ||
                                                        $user->checaAvaliadorExistenteEmEdital($edital->id, $user->id) 
                                                    )
                                                )
                                                ||
                                                $user->hasRole('edital-administrador')
                                            )
                                                <a href="{{ url( 'edital/' . $edital->id . '/inscricoes' ) }}" class="btn btn-outline-primary btn-pills waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-list"></i> Inscrições em Andamento</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row bg-white shadow border p-3 mb-3">
                <div class="col-sm-2 d-flex align-items-center">
                    <img src='{{ !!$edital->anexo_imagem ? asset("storage/$edital->anexo_imagem" ) : asset("/smartadmin-4.5.1/img/logo_proec_completo.png") }}' class="card-img-top" alt="{{ $edital->titulo }}">
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
                        @if(
                             $inscricoes->filter(function($value, $key) use ($edital){
                                return data_get($value, 'edital_id') == $edital->id;
                            })->count()   
                        )
                            <a href="{{ url( 'edital/' . $edital->id . '/suas-inscricoes' ) }}" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-address-card"></i> Sua Inscrição</a>
                        @endif
 
                       @if( 
                            (
                                strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $edital->id)) 
                                &&
                                ( $comissoes->filter(function($value, $key) use ($edital){
                                        return data_get($value, 'edital_id') == $edital->id;
                                    })->count()                                    
                                    ||
                                    $user->checaAvaliadorExistenteEmEdital($edital->id, $user->id) 
                                )
                            )
                            ||
                            $user->hasRole('edital-administrador')
                        )
                            <a href="{{ url( 'edital/' . $edital->id . '/inscricoes' ) }}" class="btn btn-warning waves-effect waves-themed my-1 font-weight-bold"> <i class="fal fa-list"></i> Inscrições em Andamento</a>
                        @endif
                    </div>
                </div>
            </div> -->
        @empty
            <div class="row bg-white shadow border p-3 mb-3">
                <h3>Não há editais</h3>
            </div>
        @endforelse
        </div>
    </div>
</div>

@endsection
