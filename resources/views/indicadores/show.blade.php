@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">
    @include('layouts._includes._status')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Indicadores</span>
            <small>
            Dados dos indicadores da unidade: <span class="text-secondary">{{$unidade->sigla}}</span>, ano base {{ $ano }} 
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="checkicon">
                <div class=" p-3 panel">
                    <!-- datatable start -->
                    <table id="dt-indicadores" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>Indicador</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($indicardoresPorUnidade as $indicardorPorUnidade)
                                <tr>
                                    <th>{{ $indicardorPorUnidade->indicador }}</th>
                                    <th>{{ $indicardorPorUnidade->valor }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Indicador</th>
                                <th>Valor</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- datatable end -->
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
