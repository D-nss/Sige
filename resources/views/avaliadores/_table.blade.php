<table class="table">
        <thead class="thead-light">
       
        <tr>
            <th>Docente</th>
            <th>Unidade</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($avaliadores as $avaliador)
            <tr>
                <td>{{ $avaliador->name }}</td>
                <td>{{ $avaliador->unidade }}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle" data-toggle="modal" data-target="#exampleModal{{ $avaliador->avaliador_id }}">
                        <i class="far fa-trash-alt"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $avaliador->avaliador_id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $avaliador->avaliador_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ url('avaliadores/' . $avaliador->avaliador_id) }}" method="post">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{ $avaliador->avaliador_id }}">Alerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                    @csrf
                                    @method('DELETE')
                                    <p>{{ $avaliador->name }}</p>
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
            @endforeach
        </tbody>
    </table>