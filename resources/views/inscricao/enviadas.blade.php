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
                            <td>{{ date('d/m/Y H:i', strtotime($inscricao->created_at)) }}</td>
                            <td>
                                <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-danger m-1"><i class="far fa-eye"></i> Ver</a>
                                @if( strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_inscricao', $inscricao->edital_id)) && $inscricao->status == 'Salvo' )
                                <a href='{{ url("inscricao/$inscricao->id/editar") }}' class="btn btn-info m-1"><i class="far fa-edit"></i> Editar</a>
                                <a href='{{ url("inscricao/$inscricao->id/orcamento") }}' class="btn btn-primary m-1"><i class="far fa-list"></i> Orçamento</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#{{$inscricao->id}}Modal">
                                    <i class="far fa-arrow-right"></i> Submeter
                                </button> -->

                                <!-- Modal -->
                                <!-- <div class="modal fade" id="{{$inscricao->id}}Modal" tabindex="-1" aria-labelledby="{{$inscricao->id}}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="{{$inscricao->id}}ModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger">Após a submissão não será possível alterar sua inscrição!</p>
                                            <p>Deseja submeter sua inscrição?</p>
                                            <form action='{{ url("inscricao/$inscricao->id/submeter") }}' method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <i class="far fa-arrow-right"></i> Submeter
                                                </button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div> -->
                                
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