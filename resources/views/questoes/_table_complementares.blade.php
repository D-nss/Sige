<div class="border border-success rounded-lg  mt-3 p-3">

    <h3 class="font-weight-bold">Questões Complementares</h3>
    <table class="table">
    <thead class="thead-light">
        <tr>
            <th>Questão</th>
            <th>Tipo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($edital->questoes as $questao)
            @if($questao->tipo == 'Complementar')
                <tr>
                    <td>{{ $questao->enunciado }}</td>
                    <td>{{ $questao->tipo }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle" data-toggle="modal" data-target="#exampleModal{{ $questao->id }}">
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
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
    </table>

</div>