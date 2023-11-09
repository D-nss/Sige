<table class="table table-bordered table-hover" id="dt-eventos-abertos" style="width: 100%">
    <thead>
        <tr>
            <th>Início</th>
            <th>Fim</th>
            <th>Título / Local</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eventosAbertos as $evento)
            <tr>
                <td>
                    <div class="flex-1">
                        {{ date('d/m/Y', strtotime($evento->data_inicio)) }}<br>
                        <span class="text-muted">{{ $diasSemana[date('D', strtotime($evento->data_inicio))] }},
                            <br>{{ date('d', strtotime($evento->data_inicio)) }} de
                            {{ $meses[date('m', strtotime($evento->data_inicio))] }}
                            <br> às {{ date('H:i', strtotime($evento->data_inicio)) }}</span>

                    </div>
                </td>
                <td>
                    <div class="flex-1">
                        {{ date('d/m/Y', strtotime($evento->data_fim)) }}<br>
                        <span class="text-muted">{{ $diasSemana[date('D', strtotime($evento->data_fim))] }},
                            <br>{{ date('d', strtotime($evento->data_fim)) }} de
                            {{ $meses[date('m', strtotime($evento->data_fim))] }}
                            <br> às {{ date('H:i', strtotime($evento->data_fim)) }}</span>
                    </div>
                </td>
                <td>
                    <span class="fs-lg fw-700 text-primary">{{ $evento->titulo }}</span>
                    <br><span class="fw-700 text-muted"><small>Local:</small> {{ $evento->local }}</span>
                    <br><span class="fw-700 text-muted"><small>(Criado em:
                            {{ date('d/m/Y', strtotime($evento->created_at)) }}. Atualização:
                            {{ date('d/m/Y', strtotime($evento->updated_at)) }})</small></span>
                </td>

                <td>
                    <span class="text-secondary">{{ $evento->user->name }}</span>
                    <div class="text-muted small text-truncate">
                        Unidade: <a href="#">{{ $evento->user->unidade->sigla }}</a>
                        <br>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column">
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <a class="btn btn-primary" href="{{ url('/eventos/' . $evento->id) }}">
                            <span class="fal fa-eye mr-1"></span>Ver Detalhes
                        </a>
                        <a class="btn btn-primary" href="{{ url('/eventos/' . $evento->id . '/editar') }}">
                            <span class="fal fa-pencil mr-1"></span>Editar
                        </a>
                        <a class="btn btn-primary" href="{{ url('evento/' . $evento->id . '/equipe') }}">
                            <span class="fal fa-user-friends mr-1"></span>Equipe
                            @if ($evento->equipe->count() > 0)
                                <span class="badge bg-danger ml-1">{{ $evento->equipe->count() }}</span>
                            @endif
                        </a>
                        <a class="btn btn-primary" href="{{ url('evento/' . $evento->id . '/inscritos') }}">
                            <span class="fal fa-users mr-1"></span>Inscrições
                            @if ($evento->inscritos->count() > 0)
                                <span class="badge bg-danger ml-1">{{ $evento->inscritos->count() }}</span>
                            @endif
                        </a>
                        <a href="#" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal{{ $evento->id }}">
                            <span class="fal fa-shield-alt mr-1"></span>Comissão
                        </a>
                        <!-- Modal center Small -->
                        <div class="modal fade" id="modal{{ $evento->id }}" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Comissão de Análise do Evento {{ $evento->titulo }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <ul class="list-group ">

                                        @if (!empty($evento->comissao))
                                            <li class="list-group-item m-3">
                                                <button type="button"
                                                    class="btn btn-sm btn-primary btn-lg btn-icon rounded-circle float-right"
                                                    data-toggle="modal"
                                                    data-target="#exampleModal{{ $evento->comissao->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <div class="mb-3">
                                                    <div class="flex-1">
                                                        <span class="text-muted">Nome</span>
                                                        <br>
                                                        <span
                                                            class="fw-500 font-size-16">{{ $evento->comissao->nome }}</span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <span class="text-muted">Atribuição</span>
                                                        <br>
                                                        <span
                                                            class="fw-500 font-size-16">{{ $evento->comissao->atribuicao }}</span>
                                                    </div>

                                                    <p class="mt-2"><span class="text-muted">Participantes </span>
                                                        <a href="{{ url('comissoes/' . $evento->comissao->id . '/novo/participante') }}"
                                                            class="btn btn-primary btn-sm btn-icon rounded-circle">
                                                            <i class="far fa-plus"></i>
                                                        </a>
                                                    </p>
                                                    @forelse($evento->comissao->users as $user)
                                                        <span
                                                            class="badge badge-pill badge-secondary d-inline-flex justify-content-center align-items-center pl-3 m-1">
                                                            <div>{{ $user->name }}</div>
                                                            <form action="{{ route('participantes.delete') }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="comissao_id"
                                                                    value="{{ $evento->comissao->id }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $user->id }}">
                                                                <button
                                                                    class="btn  btn-sm btn-icon rounded-circle text-white">
                                                                    <i class="fal fa-times mx-2"></i>
                                                                </button>
                                                            </form>

                                                        </span>
                                                    @empty
                                                        <span class="text-info fs-xs">Não há participantes nesta
                                                            comissão</span>
                                                    @endforelse
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $evento->comissao->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $evento->comissao->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ url('comissoes/' . $evento->comissao->id) }}"
                                                            method="POST">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel{{ $evento->comissao->id }}">
                                                                        Alerta</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <p>{{ $evento->comissao->nome }}</p>
                                                                    @if ($evento->comissao->users->count() > 0)
                                                                        <p>Essa comissão possui membros cadastrados.</p>
                                                                    @endif
                                                                    <p>Deseja realmente remover?</p>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Fechar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Confirmar
                                                                        remoção</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                            <form action="{{ route('comissoes.store') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <!-- inputs hidden -->
                                                    <input type="hidden" name="edital_id" id="edital_id"
                                                        value="{{ null }}">
                                                    <input type="hidden" name="unidade_id" id="unidade_id"
                                                        value="{{ null }}">
                                                    <input type="hidden" name="evento_id" id="evento_id"
                                                        value="{{ $evento->id }}">
                                                    <input type="hidden" name="atribuicao" value="Sub Comissão">
                                                    <!-- fim inputs hidden -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="nome">Nome Comissão</label>
                                                        <input type="text" class="form-control" name="nome">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar</button>
                                                    <button type="submit"
                                                        class="btn btn-primary my-1 font-weight-bold">Enviar</button>
                                                </div>
                                            </form>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
