@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<div class="container-fluid">
    @include('layouts._includes._status')
    @include('layouts._includes._validacao')

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Suas incrições</span>
            <small>
            Inscrições em que você se inscreveu
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">

            </div>
        </div>
    </div>
    <div class="row panel p-4">
        <div class="col-xl-12">

            <table class="table table-bordered table-hover" id="dt-propostas">
                <thead>
                    <tr>
                        <th>Edital</th>
                        <th>Titulo</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Data Envio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inscricoes as $inscricao)
                        <tr class="alert @if($inscricao->status == 'Pendente') alert-warning @elseif($inscricao->status == 'Deferida') alert-secondary @elseif($inscricao->status == 'Aprovada') alert-success @endif">
                            <td>{{ $inscricao->edital->titulo }}</td>
                            <td>{{ $inscricao->titulo }}</td>
                            <td>{{ $inscricao->tipo }}</td>
                            <td>{{ $inscricao->status }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($inscricao->updated_at)) }}</td>
                            <td>
                                {{ var_dump($inscricao->orcamento->items) }}
                                <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-danger m-1"><i class="far fa-eye"></i> Ver</a>
                                @if( strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_inscricao', $inscricao->edital_id)) && $inscricao->status == 'Salvo' )
                                <a href='{{ url("inscricao/$inscricao->id/editar") }}' class="btn btn-info m-1"><i class="far fa-edit"></i> Editar</a>
                                <a href='{{ url("inscricao/$inscricao->id/orcamento") }}' class="btn btn-primary m-1">
                                    <i class="far fa-list"></i> 
                                    Orçamento
                                    @if( empty($inscricao->orcamento) )
                                        <span class="badge border border-light rounded-pill bg-danger-500 position-absolute pos-top pos-right" data-toggle="tooltip" data-placement="right" title="Você possui uma pendência! Preenchimento do orçamento">!</span>
                                    @endif
                                </a>
                                <form action='{{ url("inscricao/$inscricao->id/submeter") }}' method="post" id="form-submeter">
                                    @csrf
                                    <button type="button" id="btn-submeter" class="btn btn-success m-1">
                                        <i class="far fa-arrow-right"></i> Submeter
                                    </button>
                                </form>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
