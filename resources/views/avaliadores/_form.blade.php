<!-- Default Card Example -->
<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para cadastar os conselheiros</h6>
</div>
<div class="card-body">
    <form action="{{ url('avaliadores') }}" method="POST">
        @csrf
        <input type="hidden" name="edital_id" value="{{ $edital->id }}">
        <label for="subcomissao_tematica" class="font-weight-bold">Subcomissão Temática: </label>
        <select name="subcomissao_tematica" id="subcomissao_tematica" class="form-control mb-3">
            <option value="">Selecionar ...</option>
            @foreach($subcomissoes as $subcomissao)
                <option value="{{ $subcomissao->id }}">{{ $subcomissao->nome }}</option>
            @endforeach
        </select>

        <label for="avaliador" class="font-weight-bold">Avaliador: </label>
        <select name="avaliador" id="avaliador" class="form-control mb-3">
            
        </select>

        <!-- <label for="atribuicao" class="font-weight-bold">Atribuição: </label>
        <select name="atribuicao" id="atribuicao" class="form-control mb-3">
            <option value="">Selecionar ...</option>
            <option value="">Conselheiro</option>
            <option value="">Parecerista</option>
        </select> -->

        <div class="mt-3">
            <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                Adicionar
            </button>
            
        </div>
    </form>
        
    <div class="border border-success rounded-lg  mt-3 p-3">

    <h3 class="font-weight-bold">Avaliadores</h3>
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

    </div>

    <div class="mt-3">
    <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary btn-user float-right">
        <span class="text">Finalizar</span>
    </a>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-user float-left">
        <span class="icon text-white-50">
            <i class="fal fa-long-arrow-left"></i>
        </span>
        <span class="text">Voltar</span>
    </a>
    </div>
        
        
</div>

</div>