@extends('layouts.app')

@section('title', 'Listagem dos Papeis de Usuários')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Papeis</h1>
    <div class="row">

    <div class="row mb-3">
        <div class="col-sm-3">
            <a href="/roles/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                <i class="far fa-plus"></i>
            </a>
        </div>
    </div>

    @include('layouts._includes._status')

            <!-- datatable start -->
            <table id="dt-roles" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Papel</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td><a href="{{ route('roles.edit', $role->id) }}" class="btn btn-xs btn-success waves-effect waves-themed">Editar</a><form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                             </form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- datatable end -->

    </div>
</div>
<!-- /.container-fluid -->

@endsection
