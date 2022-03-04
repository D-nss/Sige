@extends('layouts.app')

@section('title', 'Exibição dos Indicadores')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div id="checkicon">
                <h1>Dados dos indicadores da unidade 38 ano base {{ $ano }}</h1>
            
                @include('indicadores._status')

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