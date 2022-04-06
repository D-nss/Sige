@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Campos da Proposta</h1>
        <!-- Begin Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                @include('campos._form')

                </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection