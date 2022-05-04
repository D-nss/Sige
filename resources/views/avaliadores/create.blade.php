@extends('layouts.app')

@section('title', 'Cadastrar novos Conselheiros')

@section('content')
<h1>Conselheiros</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">

              @include('layouts._includes._status')

              @include('layouts._includes._validacao')

              @include('avaliadores._form')

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection





