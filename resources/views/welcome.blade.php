@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  @include('layouts._includes._status')

  <div class="row">
    <div class="col-lg-12">
      <h1 class="text-success font-weight-bold">Seja bem vindo!</h1>
      <h4><span class="text-danger font-weight-bold">Extecult</span><span class="font-color-light"> - Sistema de gestão de extensão e cultura</span></h4>
      <div class="row">
        <div class="col-md-6">
          <div class="card my-3">
            <div class="p-3">
              <h4 class="m-0 font-weight-bold text-info">Editais com inscrições abertas</h4>
            </div>
            <div class="card-body">
              
                @forelse($editais as $edital)
                  <p>{{ $edital->titulo }} 
                    <a href="{{ url('storage/' . $edital->anexo_edital) }}" class="badge badge-primary p-1"> Edital</a>
                    <a href="{{ url('inscricao/' . $edital->id .'/novo') }}" class="badge badge-danger p-1"> Inscrever-se</a>
                  </p>
                @empty
                  <p class="font-italic font-color-light">Nenhum edital com inscrição aberta.</p>
                @endforelse
            </div>
                
          </div>
        </div>
        <div class="col-md-6">
          <div class="card my-3">
            <div class="p-3">
              <h4 class="m-0 font-weight-bold text-primary">Contato</h4>
            </div>
            <div class="card-body">
              <p><span class="text-secondary font-weight-bold">Telefone:</span> (19) 3521 2541</p>
              <p><span class="text-secondary font-weight-bold">E-Mail Institucional:</span> pec@unicamp.br</p>
              <p><span class="text-secondary font-weight-bold">Endereço:</span>Av. Érico Veríssimo, 500 – Cidade Universitária “Zeferino Vaz” – Barão Geraldo
CEP 13083-851 – Campinas – SP</p>
              <p></p>
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
   
@endsection
