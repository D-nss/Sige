@extends('layouts.app')

@section('title', 'Cadastrar novo Cronograma')

@section('content')
<h1>Editar Cronograma</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">

              @include('layouts._includes._status')

              @include('cronograma._form')

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection