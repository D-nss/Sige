@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<h1>Processos de Editais</h1>
<h2>Crie e gerencie seus editais</h2>
<div class="row mb-3">
    <div class="col-sm-3">
        <a href="{{ route('editais.create') }}" class="btn btn-success btn-lg btn-icon rounded-circle" >
            <i class="far fa-plus"></i>
            Novo processo de edital
        </a>
    </div>
</div>

@include('layouts._includes._status')

<div class="row">
    @if( isset( $editais ) )
    @forelse( $editais as $edital)
    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <img src='{{ !!$edital->anexo_imagem ? asset("storage/$edital->anexo_imagem" ) : asset("/smartadmin-4.5.1/img/pdf-icon.png") }}' class="card-img-top mt-3" alt="{{ $edital->titulo }}">
        <div class="card-body">
            <h2 class="card-text font-weight-bold">{{ $edital->titulo }}</h2>
            <p><strong>Data de cadastro: </strong>{{ date('d/m/Y', strtotime($edital->created_at)) }}</p>
            <p class="">{{ substr($edital->resumo, 0, 120) . ' ... ' }}</p>
            <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-info my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>
    @empty
        <h3>Não há nenhum processo de edital cadastrado</h3>
    @endforelse
    @endif
</div>

@endsection