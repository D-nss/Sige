@extends('layouts.app')

@section('title', 'Listagem das Pemissões dos Usuários')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1>Permissões</h1>
    <div class="row">

    <div class="row mb-3">
        <div class="col-sm-3">
            <a href="/pemissions/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                <i class="far fa-plus"></i>
            </a>
        </div>
    </div>

            <!-- datatable start -->
            <table id="dt-permissions" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Permissão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td><a href="{{ route('permissions.edit', $permission->id) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Edit</a>
                                <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remover</button>
                             </form>  </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Permissão</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
            <!-- datatable end -->
    </div>
</div>
<!-- /.container-fluid -->

@endsection
