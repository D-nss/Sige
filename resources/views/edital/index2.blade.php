@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<h1>Editais</h1>
<div class="my-3">
    @include('layouts._includes._status')

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
                    
                    <a href="{{ url( 'inscricao/' . $edital->id . '/novo' ) }}" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"> <i class="far fa-arrow-alt-to-top"></i> Enviar Porpostas</a>
                            
                    <!-- <a href="#" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-list-alt"></i> Classificação</a> -->
                </div>
            </div>
        </div>
    @empty
        <div class="row bg-white shadow border p-3 mb-3">
            <h3>Não há editais</h3>
        </div>
    @endforelse

</div>

@endsection