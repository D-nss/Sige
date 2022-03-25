@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <h1>Editar Indicadores da unidade: {{$unidade->sigla}}, ano base {{ $ano }}</h1>

            <div id="panel-1" class="panel">
            <form action="{{ url('/indicadores/' . $ano) }}" method="post">
            @csrf
            @method('put')
                <div id="smartwizard" class="sw-main sw-theme-default p-4">

                @include('indicadores._form')

                </div>
            </form>
            </div>
        </div>
    </div>
</div>



@endsection
