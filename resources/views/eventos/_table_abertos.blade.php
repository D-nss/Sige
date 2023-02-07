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
                        <button type="button" class="btn btn-secondary my-1 font-weight-bold" data-toggle="modal" data-target="#modal{{ $evento->id }}"><i class="far fa-list-ol"></i> Comissão</button>
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
                                    <form action="" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="evento_id" id="evento_id" value="{{ $evento->id }}">
                                            <div class="form-group">    
                                                <label class="form-label" for="atribuicao">Atribuição</label>
                                                <select name="atribuicao" class="form-control">
                                                    <option value="">Selecione ...</option>
                                                    <option value="Avaliação">Avaliação</option>
                                                    <option value="Extensão">Extensão</option>
                                                    <option value="Sub Comissão">Sub Comissão</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-success my-1 font-weight-bold">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>