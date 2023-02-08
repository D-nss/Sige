<table class="table table-bordered table-hover" id="dt-eventos-abertos" style="width: 100%">
    <thead>
        <tr>
            <th>Período</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventosAbertos as $evento)
            
            <tr>
                <td>
                    <h4 class="fw-400 text-secondary">
                        {{ date('d/m/Y H:i:s', strtotime($evento->data_inicio)) }}
                         
                        à 
                        {{ date('d/m/Y H:i:s', strtotime($evento->data_fim)) }}
                        <small class="font-italic font-color-light">Local:{{ $evento->local }}</span>
                    </h4>
                </td>
                <td><h3 class="fw-700 text-primary">{{ $evento->titulo }}</h3></td>
                <td><h6 class="text-secondary">{{ $evento->user->name}}</h6></td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ url('/eventos/' . $evento->id) }}" class="btn btn-primary btn-xs mb-1">
                            Ver Detalhes
                        </a>
                        <a href="{{ url('/eventos/' . $evento->id . '/editar') }}" class="btn btn-info btn-xs mb-1">
                            Editar
                        </a>
                        <a href="" class="btn btn-success btn-xs mb-1">
                            Inscrições
                        </a>
                        <a href="" class="btn btn-warning btn-xs">
                            Enviar E-Mail
                        </a>
                        <button type="button" class="btn btn-secondary my-1 btn-xs mb-1" data-toggle="modal" data-target="#modal{{ $evento->id }}">Comissão</button>
                        <!-- Modal center Small -->
                        <div class="modal fade" id="modal{{ $evento->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Comissão de Análise do Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    @if($evento->comissoes)
                                    <ul class="list-group ">                        
                                    @forelse($evento->comissoes as $comissao)
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
                                                @if($comissao->evento_id != null)
                                                    <h3><span data-filter-tags="reports file"><strong>Unidade: </strong>{{ $comissao->evento->nome }}</span></h3>
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
                                    @else
                                        <form action="" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <!-- inputs hidden -->
                                                <input type="hidden" name="evento_id" id="evento_id" value="{{ $evento->id }}">
                                                <input type="hidden"  name="atribuicao" value="Sub Comissão">
                                                <!-- fim inputs hidden -->
                                                <div class="form-group">    
                                                    <label class="form-label" for="nome">Nome Comissão</label>
                                                    <input type="text" class="form-control" name="nome">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-success my-1 font-weight-bold">Enviar</button>
                                            </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>