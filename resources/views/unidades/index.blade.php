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
    <table class="table table-bordered" id="dt-unidades" width="100%" cellspacing="0">
    <thead>
    <tr>
    <th><i class="fas fa-user"></i> Id</th>
    <th><i class="fas fa-user"></i> Nome Unidade</th>
    <th><i class="fas fa-envelope"></i> SIGLA</th>
    <th><i class="far fa-clock"></i> Atualizado em</th>
    <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @foreach($unidades as $unidade)
    <tr href="/unidades/{{$unidade->id}}">
      <td>{{$unidade->id}}</td>
      <td>{{$unidade->nome}}</td>
      <td>{{$unidade->sigla}}</td>
      <td> {{$unidade->updated_at->format('d/m/Y H:i:s')}}</td>
      <td>
        <a href="{{ route('unidade.show', ['unidade' => $unidade->id]) }}">link</a>
        <form action="{{ route('unidade.destroy', ['unidade' => $unidade->id]) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Remover">
        </form>
    </td>
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
