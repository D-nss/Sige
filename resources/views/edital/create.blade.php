@extends('layouts.app')

@section('title', 'Cadastrar novo Edital')

@section('content')
<h1>Editais</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">

              <!-- Default Card Example -->
              @include('edital._form')

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection