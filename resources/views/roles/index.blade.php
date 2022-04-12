@extends('layouts.app')

@section('title', 'Listagem dos Papeis de Usuários')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

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
                            <td><a href="http://">Editar</a><a href="http://">Remover</a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><i class="fal fa-user"></i></th>
                        <th>Papel</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
            <!-- datatable end -->
</div>
<!-- /.container-fluid -->

@endsection
