@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Suas Inscrições Enviadas</h1>

<div class="panel">
    <div class="row p-4">
        <div class="col-md-12">
            
            @include('layouts._includes._status')

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
                                <a href='{{ url("inscricao/$inscricao->id/orcamento") }}' class="btn btn-primary"><i class="far fa-list"></i> Orçamento</a>
                                @endif
                                <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-info"><i class="far fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection