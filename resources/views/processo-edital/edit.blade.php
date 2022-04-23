@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Alterar Processo de Edital</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">

              @include('layouts._includes._status')
              <!-- Default Card Example -->
              @include('processo-edital._panel')

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection