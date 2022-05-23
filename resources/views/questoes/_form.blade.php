<!-- Default Card Example -->
<div class="card mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar as questões para o Edital <span class="text-success">{{ $edital->titulo }}</span></h6>
    </div>
    <div class="card-body">
        <div class="mt-3">
            <button class="btn btn-default btn-sm d-none mb-3" id="questao_existente">Usar questão existente</button>
            <form action="{{ url('questoes') }}" class="row" id="div_questao_existente" method="post">
                @csrf
                <input type="hidden" name="edital_id" value="{{ $edital->id }}">
                <div class="col-md-12">
                    <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
                    <select class="form-control mb-3" name="tipo">
                        <option value="">Selecione ...</option>
                        <option value="Avaliativa">Avaliativa</option>
                        <option value="Complementar">Complementar</option>
                    </select>

                    <label for="browser" class="font-weight-bold">Escolha a questão na Lista:</label>
                    <input list="questoes_list" class="form-control mb-3" name="enunciado">

                    <datalist id="questoes_list">
                        @foreach($edital->questoes as $questao)
                            <option value="{{ $questao->enunciado }}">
                        @endforeach
                    </datalist>

                    <button class="btn btn-primary btn-user btn-verde font-weight-bold loading-questao-existente">
                        <div class="spinner-border spinner-border-sm d-none spin" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="spin-text-questao-existente">
                            Adicionar
                        </span>
                    </button>
                </div>
            </form>
                
            <button class="btn btn-default btn-sm mt-3" id="nova_questao">Nova questão</button>

                <form action="{{ url('questoes') }}" class="row d-none" id="div_nova_questao" method="post">
                    @csrf
                    <input type="hidden" name="edital_id" value="{{ $edital->id }}">
                    <div class="col-md-12">
                        <label for="questao" class="font-weight-bold">Questão</label>
                        <textarea name="enunciado" class="form-control mb-3" id="" cols="30" rows="5"></textarea>

                        <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
                        <select class="form-control mb-3" name="tipo">
                            <option value="">Selecione ...</option>
                            <option value="Avaliativa">Avaliativa</option>
                            <option value="Complementar">Complementar</option>
                        </select>

                        <button class="btn btn-primary btn-user btn-verde font-weight-bold loading-nova-questao">
                            <div class="spinner-border spinner-border-sm d-none spin" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <span class="spin-text-nova-questao">
                                Adicionar
                            </span>
                        </button>
                    </div>
                </form>

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

            <div class="border border-primary rounded-lg  mt-3 p-3">

                <h3 class="font-weight-bold">Questões de Avaliação</h3>
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
                        @if($questao->tipo == 'Avaliativa')
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

            <div class="mt-3">
                <a href='{{ url("processo-editais/$edital->id/editar") }}' class="btn btn-primary float-right">Finalizar</a>
                <a href="#" onclick="history.back()" class="btn btn-secondary btn-user float-left">
                    <span class="icon text-white-50">
                        <i class="fal fa-long-arrow-left"></i>
                    </span>
                    <span class="text">Voltar</span>
                </a>
            </div>
            
        </div>
    </div>
</div>