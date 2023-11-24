<div class="panel p-3 mt-3">
    <div class="panel-header">
        <h4>Questões</h4>
    </div>
    <div class="panel-body">
    <ul class="list-group list-group-flush">
    @foreach($edital->questoes as $questao)
        @if($questao->tipo == 'Complementar')
        <li class="list-group-item">
            <div class="d-flex flex-column">
                <span class="text-dark fw-500 fs-xl">{{ $questao->enunciado }}</span>
                <small class="text-muted fw-200">{{ $questao->tipo }}</small>
            </div>
            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-pills waves-effect waves-themed" data-toggle="modal" data-target="#exampleModal{{ $questao->id }}">
                    <i class="far fa-trash-alt"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $questao->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $questao->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ url('questoes/'. $questao->id) }}" method="POST">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $questao->id }}">Alerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    @csrf
                                    @method('DELETE')
                                    <p>{{ $questao->enunciado }}</p>
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
            </div>
        </li>
        @endif
    @endforeach
    </ul>
    <hr>
    <ul class="list-group list-group-flush">
    @foreach($edital->questoes as $questao)
        @if($questao->tipo == 'Avaliativa')
        <li class="list-group-item">
            <div class="d-flex flex-column">
                <span class="text-dark fw-500 fs-xl">{{ $questao->enunciado }}</span>
                <small class="text-muted fw-200">{{ $questao->tipo }}</small>
            </div>
            <div class="float-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-pills waves-effect waves-themed" data-toggle="modal" data-target="#exampleModal{{ $questao->id }}">
                    <i class="far fa-trash-alt"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $questao->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $questao->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ url('questoes/'. $questao->id) }}" method="POST">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $questao->id }}">Alerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    @csrf
                                    @method('DELETE')
                                    <p>{{ $questao->enunciado }}</p>
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
            </div>
        </li>
        @endif
    @endforeach
    </ul>
    </div>
</div>
