@extends('layouts.app')

@section('title', 'Listagem dos Usuarios')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

            <!-- datatable start -->
            <table id="dt-usuarios" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Matricula</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Acessado em</th>
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
                                <a href="{{ route('user.show', ['user' => $usuario->id]) }}">link</a>
                                <form action="{{ route('user.destroy', ['user' => $usuario->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Remover">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Matricula</th>
                        <th>Unidade</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Acessado em</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
            <!-- datatable end -->
</div>
<!-- /.container-fluid -->

@endsection
