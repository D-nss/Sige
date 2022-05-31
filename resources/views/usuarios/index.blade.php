@extends('layouts.app')

@section('title', 'Listagem dos Usuarios')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Lista dos Usuários</h1>

            @include('layouts._includes._status')

            <div class="row mb-3">
                <div class="col-sm-3">
                    <a href="/usuarios/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                        <i class="far fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-green">Para ver detalhes e atualizar os dados, clique sobre o botão link do registro.</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">

            <!-- datatable start -->
            <table id="dt-usuarios" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Criado em</th>
                        <th>Último acesso</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->unidade->sigla}}</td>
                            <td>{{$usuario->email}}</td>
                            <td> {{$usuario->created_at->format('d/m/Y H:i:s')}}</td>
                            <td> {{$usuario->updated_at->format('d/m/Y H:i:s')}}</td>
                            <td>
                                @if ($usuario->ativo)
                                    <span class="badge badge-success badge-pill">Ativo</span>
                                @else
                                    <span class="badge badge-danger badge-pill">Desativado</span>
                                @endif
                            <td>
                                <a style="float: left;" class="btn btn-xs btn-success waves-effect waves-themed" href="{{ route('user.show', ['user' => $usuario->id]) }}">link</a>
                                @if ($usuario->ativo)
                                    <form action="{{ route('user.desativar', ['user' => $usuario->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-xs btn-dark waves-effect waves-themed">Desativar</button>
                                    </form>
                                @else
                                    <form action="{{ route('user.ativar', ['user' => $usuario->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-xs btn-info waves-effect waves-themed">Ativar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- datatable end -->
        </div>
        </div>
        </div>
</div>
<!-- /.container-fluid -->

@endsection
