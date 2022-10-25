@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item">Avaliação</li>
    <li class="breadcrumb-item active">Nova Avaliação</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Avaliação</span>
        <small>
        Efetuar avaliação da inscrição <span class="text-secondary">{{$inscricao->titulo}}</span>
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12">

        <div class="card row">
            <div class="card-body">
            @if( empty($notasAvaliacao->toArray()) )
                <form action='{{ url("/inscricao/$inscricao->id/avaliacao") }}' method="post" id="avaliacao-form">
            @else
                <form action='{{ url("/inscricao/$inscricao->id/avaliacaoUpdate") }}' method="post" id="avaliacao-form">
                @method('PUT')
            @endif
                @csrf

                <input type="hidden" name="tipo_avaliacao" value="parecerista">

                @foreach($questoesAvaliacao as $questaoAvaliacao)

                <div class="rounded mb-2 p-2 w-100">
                    <label for="" class="text-secondary font-size-14 fw-500">{{ $questaoAvaliacao->enunciado }}</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="1"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 1 ) checked @endif
                            >
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="2"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 2  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="3"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 3 ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="4"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 4  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio1">4</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="5"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 5  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio2">5</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="6"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 6  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio3">6</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio1" value="7"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 7  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio1">7</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio2" value="8"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 8  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio2">8</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="9"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 9  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio3">9</label>
                        </div>
                        <div class="form-check form-check-inline border p-2 mr-2 rounded">
                            <input class="form-check-input" type="radio" name="questao-{{ $questaoAvaliacao->id }}" id="inlineRadio3" value="10"
                                @if( !empty($notasAvaliacao->toArray()) && $notasAvaliacao->where('questao_id', $questaoAvaliacao->id)->pluck('valor')[0] == 10  ) checked  @endif
                            >
                            <label class="form-check-label" for="inlineRadio3">10</label>
                        </div>
                    </div>

                </div>
                @endforeach
                <label for="" class="text-secondary font-size-14 fw-500">Justificativa das Notas</label>
                <textarea class="form-control mb-1" name="justificativa" id="justificativa" rows="10">@if( !empty($parecerAvaliacao->toArray()) ){{ $parecerAvaliacao->pluck('justificativa')[0] }}@else{{ old('justificativa') }}@endif</textarea>
		        <span style="color: #D0D3D4;">(máx 1000 caractere)</span>
                <label for="" class="text-secondary font-size-14 fw-500">Parecer da avaliação</label>
                <textarea class="form-control mb-1" name="parecer" id="parecer" rows="10">@if( !empty($parecerAvaliacao->toArray()) ){{ $parecerAvaliacao->pluck('parecer')[0] }}@else{{ old('parecer') }}@endif</textarea>
               	<span style="color: #D0D3D4;">(máx. 1000 caracteres</span>
		        <div class="mt-3">
                    <button class="btn btn-success">Enviar</button>

                    <a href="javascript:history.back()" class="btn btn-secondary btn-user float-right mt-2">
                          <span class="icon text-white-50">
                              <i class="fal fa-long-arrow-left"></i>
                          </span>
                          <span class="text">Voltar</span>
                      </a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
        <!-- /.container-fluid -->

@endsection
