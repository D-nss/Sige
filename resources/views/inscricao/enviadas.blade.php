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
                            <td>{{ $inscricao->titulo }}</td>
                            <td>{{ $inscricao->tipo }}</td>
                            <td>{{ $inscricao->status }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($inscricao->created_at)) }}</td>
                            <td>
                                @if( strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_inscricao', $inscricao->edital_id)) )
                                <a href='{{ url("inscricao/$inscricao->id/editar") }}' class="btn btn-info"><i class="far fa-edit"></i> Editar</a>
                                <a href='{{ url("inscricao/$inscricao->id/orcamento") }}' class="btn btn-primary"><i class="far fa-list"></i> Orçamento</a>
                                @endif
                                <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-danger"><i class="far fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection