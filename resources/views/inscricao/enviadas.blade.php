@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Listagem de Inscrições</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success">Inscrições</span>
        <small>
        Inscrições em que você se inscreveu
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">

        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="row panel p-4">
        <div class="col-xl-12">

            <table class="table table-bordered table-hover" id="dt-propostas" style="width: 100%">
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
                                <div class="">
                                    <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-danger btn-xs  m-1"><i class="far fa-eye"></i> Ver</a>
                                    @if( strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_inscricao', $inscricao->edital_id)) && $inscricao->status == 'Salvo' )
                                        <a href='{{ url("inscricao/$inscricao->id/editar") }}' class="btn btn-info btn-xs m-1"><i class="far fa-edit"></i> Editar</a>
                                        <a href='{{ url("inscricao/$inscricao->id/orcamento") }}' class="btn btn-primary btn-xs m-1">
                                            <i class="far fa-list"></i> 
                                            Orçamento
                                            @if( empty($inscricao->orcamento->toArray()) )
                                                <span class="badge bg-danger-300 ml-2 px-2" data-toggle="tooltip" data-placement="top" title="Você possui uma pendência! Preenchimento do orçamento"><strong class="text-light">!</strong></span>
                                            @endif
                                        </a>
                                        <form action='{{ url("inscricao/$inscricao->id/submeter") }}' method="post" id="form-submeter">
                                            @csrf
                                            <button type="button" id="btn-submeter" class="btn btn-success btn-xs m-1">
                                                <i class="far fa-arrow-right"></i> Submeter
                                            </button>
                                        </form>
                                        
                                    @endif
                                    
                                    <a href='{{ url("recurso/$inscricao->id") }}' class="btn btn-warning btn-xs m-1"><i class="far fa-list"></i> Recurso</a>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
