<div class="my-3 col-6">
    <ul class="list-group">
    @if( isset( $criterios ) )
        @foreach( $criterios as $criterio )
        <li class="list-group-item">
            <span class="text-primary fw-700">{{ $criterio->descricao }}</span>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-outline-primary btn-pills waves-effect waves-themed float-right" data-toggle="modal" data-target="#exampleModal{{ $criterio->id }}">
                <i class="far fa-trash-alt"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $criterio->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $criterio->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ url('criterios/'. $criterio->id) }}" method="POST">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $criterio->id }}">Alerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    @csrf
                                    @method('DELETE')
                                    <p>{{ $criterio->descricao }}</p>
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
        @endforeach
    @endif
    </ul>
</div>