@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<h1>Editais</h1>
<div class="my-3">
    @forelse($editais as $edital)
        <div class="row bg-white shadow border p-3 mb-3">
            <div class="col-sm-2 d-flex align-items-center">
                <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top" alt="...">
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <p class="font-weight-bold" style="font-size: 16px;">1º Edital ProEC-PEx 2021 em tempos de covid-19</p>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <p style="font-size: 12px; color: #999;">A Pró-Reitoria de Extensão e Cultura lança o 1° Edital ProEC-PEx 2021 em tempos de covid-19 para apoiar financeiramente os projetos de Extensão Universitária, formulados por docentes e pesquisadores da UNICAMP.</p>
            </div>
            <div class="col-sm-4 d-flex align-items-center">
                <div>
                    <a href="#" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-file-pdf"></i> Edital em PDF</a>
                    <a href="#" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"> <i class="far fa-arrow-alt-to-top"></i> Enviar Porpostas</a>
                    <a href="#" class="btn btn-primary waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-list-alt"></i> Classificação</a>
                </div>
            </div>
        </div>
        @empty
            <div class="row bg-white shadow border p-3 mb-3">
                <h3>Não há editais incluídos</h3>
            </div>
        @endforelse

</div>

@endsection