@extends('layouts.app')

@section('title', 'Cadastro de Indicadores')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <h1>Adicionar Indicadores da unidade - {{$unidade->sigla}}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="panel-1" class="panel">
            <form action="{{ url('/indicadores') }}" method="post">
            @csrf
                <div id="smartwizard" class="sw-main sw-theme-default p-4">

                @include('indicadores._form')

                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection

