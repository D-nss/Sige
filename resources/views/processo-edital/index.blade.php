@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<h1>Processos de Editais</h1>
<div class="row">
    <div class="col-sm-3">
        <button type="button" class="btn btn-success btn-lg btn-icon rounded-circle" data-toggle="modal" data-target="#Modal">
            <i class="far fa-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Novo Processo de Edital</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="dt_divulgacao" class="font-weight-bold">Nome do Processo</label>
                <input type="text" name="nome_processo" class="form-control mb-3" placeholder="Digite um nome para o processo" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="{{ url('processo-editais/novo') }}" class="btn btn-primary">Prosseguir</a>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <!-- <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top mt-3" alt="..."> -->
        <div class="card-body">
            <h2 class="card-text font-weight-bold">Processo de Edital ProEC-PEx 2021</h2>
            <p><strong>Data de cadastro: </strong>22/03/2022</p>
            <a href="#" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>

    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <!-- <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top mt-3" alt="..."> -->
        <div class="card-body">
            <h2 class="card-text font-weight-bold">Processo de Edital ProEC-PEx 2021</h2>
            <p><strong>Data de cadastro: </strong>22/03/2022</p>
            <a href="#" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>

    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <!-- <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top mt-3" alt="..."> -->
        <div class="card-body">
            <h2 class="card-text font-weight-bold">Processo de Edital ProEC-PEx 2021</h2>
            <p><strong>Data de cadastro: </strong>22/03/2022</p>
            <a href="#" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>

    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <!-- <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top mt-3" alt="..."> -->
        <div class="card-body">
            <h2 class="card-text font-weight-bold">Processo de Edital ProEC-PEx 2021</h2>
            <p><strong>Data de cadastro: </strong>22/03/2022</p>
            <a href="#" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>

    <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
        <!-- <img src="{{ asset('smartadmin-4.5.1/img/logo_pex_21_covid.png')}}" class="card-img-top mt-3" alt="..."> -->
        <div class="card-body">
            <h2 class="card-text font-weight-bold">Processo de Edital ProEC-PEx 2021</h2>
            <p><strong>Data de cadastro: </strong>22/03/2022</p>
            <a href="#" class="btn btn-info waves-effect waves-themed my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
        </div>
    </div>

</div>

@endsection