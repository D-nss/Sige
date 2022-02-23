@extends('layouts.app')

@section('title', 'Editar Unidade')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-6">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para editar a Unidade</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('unidade.update', ['unidade' => $unidade->id])}}" method="POST">
                        @csrf
                        @method('put')
                        @include('unidades._form')
                        <button class="btn btn-primary btn-user btn-block btn-verde">
                            Editar Unidade
                        </button>
                        <a href="/unidades" class="btn btn-secondary btn-user btn-block ">
                            <span class="icon text-white-50">
                              <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Voltar</span>
                          </a>
                      </form>
                </div>
              </div>

            </div>
          </div>



        </div>
        <!-- /.container-fluid -->
@endsection

