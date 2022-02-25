@extends('layouts.app')

@section('title', 'Listagem dos Usuarios')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

            <!-- datatable start -->
            <table id="dt-usuarios" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Nome</th>
                        <th>Matricula</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Telefone</th>
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
                            <td>Matricula</td>
                            <td>{{$usuario->unidade->sigla}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>Telefone</td>
                            <td> {{$usuario->updated_at->format('d/m/Y H:i:s')}}</td>
                            <td>
                                @if ($usuario->ativo)
                                    <span class="badge badge-success badge-pill">Ativo</span>
                                @else
                                    <span class="badge badge-danger badge-pill">Desativado</span>
                                @endif
                            <td>
                                <a href="{{ route('user.show', ['user' => $usuario->id]) }}">link</a>
                                @if ($usuario->ativo)
                                    <form action="{{ route('user.desativar', ['user' => $usuario->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="submit" value="Desativar">
                                    </form>
                                @else
                                    <form action="{{ route('user.ativar', ['user' => $usuario->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="submit" value="Ativar">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Nome</th>
                        <th>Matricula</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Acessado em</th>
                        <th>Estado</th>

                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
            <!-- datatable end -->
</div>
<!-- /.container-fluid -->

@endsection
