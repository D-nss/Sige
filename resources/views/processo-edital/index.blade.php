@extends('layouts.app')

@section('title', 'Editais')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos de Editais</li>
    <li class="breadcrumb-item active">Listagem Processos</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Processos de Editais</span>
        <small>
            Crie e gerencie seus editais
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
            
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12">
            <a href="{{ route('editais.create') }}" class="btn btn-success btn-lg btn-icon rounded-circle" >
                <i class="far fa-plus"></i>
            </a>
            Novo processo de edital
        </div>
    </div>

    <div class="row">
        @if( isset( $editais ) )
        @forelse( $editais as $edital)
        
        <div class="card border m-3 col-md-4 shadow" style="max-width: 18rem;">
            <img src='{{ !!$edital->anexo_imagem ? asset("storage/$edital->anexo_imagem" ) : asset("/smartadmin-4.5.1/img/pdf-icon.png") }}' class="card-img-top mt-3" alt="{{ $edital->titulo }}">
            <div class="card-body">
                <h2 class="card-text font-weight-bold">{{ $edital->titulo }}</h2>
                <p><strong>Data de cadastro: </strong>{{ date('d/m/Y', strtotime($edital->created_at)) }}</p>
                <p class="">{{ substr($edital->resumo, 0, 120) . ' ... ' }}</p>
                <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-info my-1 font-weight-bold"><i class="far fa-edit"></i> Editar</a>
                @if( strtotime($cronograma->getDate('dt_divulgacao_previa', $edital->id)) !== false && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_divulgacao_previa', $edital->id)) )
                    @if( !isset($edital->inscricoes->first()->nota) )
                    <button type="button" class="btn btn-warning my-1 font-weight-bold" data-toggle="modal" data-target="#default-example-modal-sm-center"><i class="far fa-list-ol"></i> Classificar</button>
                    <!-- Modal center Small -->
                    <div class="modal fade" id="default-example-modal-sm-center" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Classificação</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <form action="{{ url('edital/' . $edital->id .'/classificar') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="panel-tag">
                                               Selecione a forma de avaliação, o sistema irá calcular as notas e automaticamente e organizará em ordem decrescente, sendo da nota maior para a menor.
                                        </div>
                                        <label class="form-label" for="forma_avaliacao">Forma de Avaliação</label>
                                        <select class="form-control" name="forma_avaliacao" id="forma_avaliacao" required>
                                            <option value="">Selecione ...</option>
                                            <option value="soma">Soma</option>
                                            <option value="media">Media</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success my-1 font-weight-bold">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href='{{ url("edital/$edital->id/listar-classificados") }}' class="btn btn-primary"><i class="fal fa-eye"></i> Classificação</a>
                    @endif
                @endif
            </div>
        </div>
        @empty
        <div class="col-md-6">
            <h4 class="font-color-light">Não há nenhum processo de edital cadastrado</h4>
        </div>
        @endforelse
        @endif
    </div>

</div>

@endsection