@extends('layouts.app')

@section('title', 'Listagem das Unidades')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Unidades</h1>

    <div class="row mb-3">
        <div class="col-sm-3">
            <a href="/unidades/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                <i class="far fa-plus"></i>
            </a>
        </div>
    </div>

    @include('layouts._includes._status')

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
    <th>Nome</th>
    <th>Sigla</th>
    <th>Atualizado em</th>
    <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    @foreach($unidades as $unidade)
    <tr href="/unidades/{{$unidade->id}}">
      <td>{{$unidade->nome}}</td>
      <td>{{$unidade->sigla}}</td>
      <td> {{$unidade->updated_at->format('d/m/Y H:i:s')}}</td>
      <td>
        <a style="float: left;" class="btn btn-xs btn-success waves-effect waves-themed"  href="{{ route('unidade.show', ['unidade' => $unidade->id]) }}">link</a>
        <form action="{{ route('unidade.destroy', ['unidade' => $unidade->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-xs btn-dark waves-effect waves-themed">Remover</button>
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
