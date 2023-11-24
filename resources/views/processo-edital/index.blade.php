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
            <a href="{{ route('editais.create') }}" class="btn btn-primary btn-pills waves-effect waves-themed btn-lg" >
                <i class="far fa-plus"></i>
                Novo processo de edital
            </a>
        </div>
    </div>

    <div class="row">
        @if( isset( $editais ) )
        @forelse( $editais as $edital)
        
        <div class="card m-3 col-md-4 shadow" style="max-width: 18rem;">
            <div class="card-header">
                <h5 class="card-text font-weight-bold">{{ $edital->titulo }}</h5>
            </div>
            <div class="card-body">      
                <p><strong>Data de cadastro: </strong>{{ date('d/m/Y', strtotime($edital->created_at)) }}</p>
                <p class="text-justify">{{ substr($edital->resumo, 0, 120) . ' ... ' }}</p>
                <img src='{{ !!$edital->anexo_imagem ? asset("storage/$edital->anexo_imagem" ) : asset("/smartadmin-4.5.1/img/logo_proec_completo.png") }}' class="img-fluid mx-auto my-3" alt="{{ $edital->titulo }}">   
            </div>
            <div class="card-footer">
                <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary btn-pills waves-effect waves-themed my-1"><i class="far fa-edit"></i> Editar</a>
                @if( strtotime($cronograma->getDate('dt_divulgacao_previa', $edital->id)) !== false && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_divulgacao_previa', $edital->id)) )
                @if( !isset($edital->inscricoes->firstWhere('nota', '<>', NULL)->nota) || (strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_termino_recurso', $edital->id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_resultado', $edital->id))) )
                    <button type="button" class="btn btn-outline-primary btn-pills waves-effect waves-themed my-1" data-toggle="modal" data-target="#modal{{ $edital->id }}"><i class="far fa-list-ol"></i> Classificar</button>
                    <!-- Modal center Small -->
                    <div class="modal fade" id="modal{{ $edital->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <button type="button" class="btn btn-outline-primary btn-pills waves-effect waves-themed" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary btn-pills waves-effect waves-themed my-1 font-weight-bold">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href='{{ url("edital/$edital->id/listar-classificados") }}' class="btn btn-outline-primary btn-pills waves-effect waves-themed"><i class="fal fa-eye"></i> Classificação</a>
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