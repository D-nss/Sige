@extends('layouts.app')

@section('title', 'Listagem das Pemissões dos Usuários')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>Permissões</h1>
    <div class="row mb-3">
        <div class="col-sm-3">
            <a href="/permissions/novo" class="btn btn-success btn-lg btn-icon rounded-circle" >
                <i class="far fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-green">Para ver detalhes e atualizar os dados, clique sobre o botão editar do registro.</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                                <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-xs btn-success waves-effect waves-themed">Edit</a>
                                    <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" onsubmit="return confirm('Voce tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">Remover</button>
                                </form>  </td>
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
