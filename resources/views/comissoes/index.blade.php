@extends('layouts.app')

@section('title', 'Comissões')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Processos Editais</li>
    <li class="breadcrumb-item">Comissões</li>
    <li class="breadcrumb-item active">Listagem Comissões</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-edit'></i>Comissões</span>
        <small>
        Listagem das Comissões cadastradas
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
            
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ url('comissoes/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
            <i class="far fa-plus"></i>
        </a>
        Adicionar Comissão
    </div>
    
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
            <span class="fw-300"><i>Preencha todos os campos do formulário de cadastro de comissão</i></span>
            </h2>
            <!-- <div class="panel-toolbar">
                <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
            </div> -->
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                
                
                <ul class="list-group ">                        
                    @forelse($comissoes as $comissao)
                        <li class="list-group-item bg-info-50 mb-1">
                        <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle float-right" data-toggle="modal" data-target="#exampleModal{{$comissao->id}}">
                            <i class="far fa-trash-alt"></i>
                            </button>
                            <div class="mb-3">
                                @if($comissao->edital_id != null)
                                    <h3><span data-filter-tags="reports file"><strong>Edital: </strong>{{ $comissao->edital->titulo }}</span></h3>
                                @endif
                                @if($comissao->unidade_id != null)
                                    <h3><span data-filter-tags="reports file"><strong>Unidade: </strong>{{ $comissao->unidade->sigla }}</span></h3>
                                @endif
                                <p><span data-filter-tags="reports file"><strong>Nome: </strong>{{ $comissao->nome }}</span></p>
                                <p><span data-filter-tags="reports file"><strong>Atribuição: </strong>{{ $comissao->atribuicao}}</span></p>

                                <p><span data-filter-tags="reports file"><strong>Participantes: </strong> 
                                    <a href="{{ url('comissoes/'.$comissao->id.'/novo/participante') }}" class="btn btn-primary btn-sm btn-icon rounded-circle">
                                        <i class="far fa-plus"></i>
                                    </a>
                                </p>
                                @foreach($comissao->users as $user)
                                    <span class="badge badge-pill badge-secondary d-inline-flex justify-content-center align-items-center pl-3">
                                        <div>{{ $user->name }}</div>
                                        <form action="{{ route('participantes.delete') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="comissao_id" value="{{ $comissao->id }}">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button class="btn  btn-sm btn-icon rounded-circle text-white">
                                                <i class="fal fa-times mx-2"></i>
                                            </button>
                                        </form>
                                        
                                    </span>
                                    
                                @endforeach
                            </div>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $comissao->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $comissao->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ url('comissoes/'. $comissao->id) }}" method="POST">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $comissao->id }}">Alerta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                                @csrf
                                                @method('DELETE')
                                                <p>{{ $comissao->nome }}</p>
                                                @if($comissao->users->count() > 0)
                                                    <p>Essa comissão possui membros cadastrados.</p>
                                                @endif
                                                <p>Deseja realmente remover?</p>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-danger">Confirmar remoção</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                        </li>
                        
                    @empty
                        <li class="list-group-item">
                            <span data-filter-tags="reports file">Sem comissões cadastrada</span>
                        </li>
                    @endforelse
                    </ul>
    </div>
    </div>
    </div>
</div>
@endsection

