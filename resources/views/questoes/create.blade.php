@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Questões</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">

              @include('layouts._includes._status')

              @include('layouts._includes._validacao')

              @include('questoes._form')

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection