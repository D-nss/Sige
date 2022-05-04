@extends('layouts.app')

@section('title', 'Listagem dos Usuarios')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Lista dos Usuários</h1>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-sm-3">
                    <a href="/usuarios/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                        <i class="far fa-plus"></i>
                    </a>
                </div>
            </div>

            <!-- datatable start -->
            <table id="dt-usuarios" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Acessado em</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->id}}</td>
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->unidade->sigla}}</td>
                            <td>{{$usuario->email}}</td>
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
<!-- /.container-fluid -->

@endsection
