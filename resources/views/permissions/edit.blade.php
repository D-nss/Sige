@extends('layouts.app')

@section('title', 'Editar Permissão')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-6">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para editar a Permissão</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('permissions.update', ['permission' => $permission->id])}}" method="POST">
                        @csrf
                        @method('put')
                        @include('permissions._form')
                        <button class="btn btn-primary btn-user btn-block btn-verde">
                            Editar Permissão
                        </button>
                        <a href="/permissions" class="btn btn-secondary btn-user btn-block ">
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
                  <h6 class="m-0 font-weight-bold text-green">Papeis que possuem a permissão:</h6>
                </div>
                <div class="card-body">

                    <div class="form-control">
                        @if ($permission->roles)
                            @foreach ($permission->roles as $permission_role)
                                <form method="POST"
                                    action="{{ route('permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                    onsubmit="return confirm('Você tem certeza?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $permission_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl mt-6">
                        <form method="POST" action="{{ route('permissions.roles', $permission->id) }}">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="role" >Papeis:</label>
                                <select id="role" name="role" autocomplete="role-name">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit">Atribuir</button>
                    </div>
                    </form>

                </div>
              </div>

            </div>
          </div>



        </div>
        <!-- /.container-fluid -->
@endsection

