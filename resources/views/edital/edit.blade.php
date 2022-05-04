@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<h1>Alterar Edital</h1>
        
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              
              @include('layouts._includes._status')

              @include('layouts._includes._validacao')
              
              @include('edital._form')

            </div>
          </div>
        </div>

@endsection