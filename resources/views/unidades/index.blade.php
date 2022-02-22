@extends('layouts.app')

@section('title', 'Listagem das Unidades')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Para ver detalhes e atualizar os dados, clique sobre o registro na tabela abaixo.</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTables-usuarios" width="100%" cellspacing="0">
    <thead>
    <tr>
    <th><i class="fas fa-user"></i> Id</th>
    <th><i class="fas fa-user"></i> Nome Unidade</th>
    <th><i class="fas fa-envelope"></i> SIGLA</th>
    <th><i class="fas fa-envelope"></i> Url Site</th>
    <th><i class="far fa-clock"></i> Atualizado em</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dados['unidades'] as $unidade)
    <tr href="/unidades/{{$unidade->id}}">
      <td>{{$unidade->id}}</td>
      <td>{{$unidade->nome}}</td>
      <td>{{$unidade->sigla}}</td>
      <td>{{$unidade->url}}</td>
      <td> {{$unidade->updated_at->format('d/m/Y H:i:s')}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    @endsection
