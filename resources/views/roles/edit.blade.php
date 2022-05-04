@extends('layouts.app')

@section('title', 'Editar Papel')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1>Editar Papel</h1>
          <div class="row">

            <div class="col-lg-6">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para editar o Papel</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('roles.update', ['role' => $role->id])}}" method="POST">
                        @csrf
                        @method('put')
                        @include('roles._form')
                        <button class="btn btn-primary btn-user btn-block btn-verde">
                            Editar Papel
                        </button>
                        <a href="/roles" class="btn btn-secondary btn-user btn-block ">
                            <span class="icon text-white-50">
                              <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                          </a>
                      </form>
                </div>
              </div>

              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-green">Permissões do Papel {{$role->name}}:</h6>
                </div>
                <div class="card-body">
                    <div class="form-control">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <form method="POST"
                                    action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                    onsubmit="return confirm('Você tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-xs btn-danger waves-effect waves-themed" type="submit">{{ $role_permission->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="row mb-3">
                        <label for="permission" class="col-md-4 col-form-label text-md-end">Permissão</label>
                        <form method="POST" action="{{ route('roles.permissions', $role->id) }}">
                            @csrf
                            <div class="col-md-6">
                                <select class="form-control" id="permission" name="permission" autocomplete="permission-name"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('name')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-control">
                        <button type="submit"
                        class="btn btn-xs btn-success waves-effect waves-themed" >Atribuir</button>
                    </div>
                    </form>

                </div>
              </div>

            </div>
          </div>



        </div>
        <!-- /.container-fluid -->
@endsection

