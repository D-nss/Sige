@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Inscrições</h1>

<div class="row p-4">
    <div class="col-md-12">
        <div class="card">
            @include('layouts._includes._status')

            <div class="card-body">
                @include('inscricao._table')
            </div>
            
        </div>
    </div>
</div>

@endsection