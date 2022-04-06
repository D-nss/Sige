@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Propostas</h1>

<div class="panel">
    <div class="row p-4">
        <div class="col-md-12">
            @include('proposta._table')
        </div>
    </div>
</div>

@endsection