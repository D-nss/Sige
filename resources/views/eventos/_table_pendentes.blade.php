<table class="table table-bordered table-hover" id="dt-eventos-abertos" style="width: 100%">
    <thead>
        <tr>
            <th>Início</th>
            <th>Fim</th>
            <th>Nome / Local</th>
            <th>Autor</th>
            <th>Mais ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eventosPendentes as $evento)
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
                        <br> às {{ date('H:i', strtotime($evento->data_fim)) }}</span><br>
                </div>
            </td>
            <td>
                <h4 class="nome-evento text-primary"><a href="{{ url('/eventos/' . $evento->id) }}">
                        {{ $evento->titulo }}</a>
                    </h4>

                <div class="acoes-evento">
                    <a class="btn-negativo" href="#" data-toggle="modal" data-target="#modalEncerrar{{ $evento->id }}">
                        <span class="a-ic-bt-peq fal fa-check-circle"></span>Encerrar
                    </a>
                    <a class="btn-negativo" href="{{ url('/eventos/' . $evento->id) }}">
                        <span class="a-ic-bt-peq fal fa-eye"></span>Ver Detalhes
                    </a>
                    <a class="btn-negativo" href="{{ url('/eventos/' . $evento->id . '/editar') }}">
                        <span class="a-ic-bt-peq fal fa-pencil"></span>Editar
                    </a>
                </div>

                <span class="fw-700 text-muted"><small>Local:</small> {{ $evento->local }}</span>
                <br><span class="fw-700 text-muted"><small>(Criado em:
                        {{ date('d/m/Y', strtotime($evento->created_at)) }}. Atualização:
                        {{ date('d/m/Y', strtotime($evento->updated_at)) }})</small></span>
                <br><br>
                <h4 class="text-danger">
                    <i class="far fa-exclamation-triangle"></i> Pendênte há {{ now()->diffindays($evento->data_fim)}} dias
                </h4>

            </td>

            <td>
                <span class="text-secondary">{{ $evento->user->name }}</span>
                <div class="text-muted small text-truncate">
                    Unidade:
                    <!-- <a href="#"> -->{{ $evento->user->unidade->sigla }}
                    <!--</a>-->
                    <br>
                </div>
            </td>
            <td>
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalEncerrar{{ $evento->id }}">
                        <span class="fal fa-check-circle"></span> Revisar e Encerrar
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="modalEncerrar{{ $evento->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $evento->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('evento.encerrar', ['evento' => $evento->id])}}" method="post">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $evento->id }}">Revisar informações</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                        @csrf
                                        @method('PUT')
                                        <p>Atualize as informações pendentes. Quando terminar a revisão, encerre o evento clicando no botão Encerrar Evento.</p>
                                        <h3>Apontamentos</h3>
                                        <p><a class="btn btn-primary" href="{{ url('evento/' . $evento->id . '/equipe') }}">
                                            <span class="a-ic-bt-peq fal fa-user-friends"></span>Equipe
                                            @if ($evento->equipe->count() > 0)
                                            <span class="badge bg-danger">{{ $evento->equipe->count() }}</span>
                                            @endif
                                        </a>
                                        <a class="btn btn-primary" href="{{ url('evento/' . $evento->id . '/inscritos') }}">
                                            <span class="a-ic-bt-peq fal fa-users"></span>Inscrições
                                            @if ($evento->inscritos->count() > 0)
                                            <span class="badge bg-danger ml-1">{{ $evento->inscritos->count() }}</span>
                                            @endif
                                        </a>
                                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalCertificado{{ $evento->id }}">
                                            <span class="a-ic-bt-peq fal fa-file-certificate"></span>Certificado
                                        </a>
                                    </p>
                                    <p class="text-danger">
                                        Atenção! Ao encerrar o evento, não poderá fazer novas alterações. Esta ação é definitiva.
                                    </p>
                                    <hr>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fal fa-times"></span> Fechar sem Encerrar</button>
                                    <button type="submit" class="btn btn-primary"><span class="fal fa-check-circle"></span> Encerrar Evento</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalCertificado{{ $evento->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $evento->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{route('evento.updateCertificado', ['evento' => $evento->id])}}" method="post">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $evento->id }}">Alterar Certificado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                        @csrf
                                        @method('PUT')
                                        <div class=" @error('modelo') border border-danger rounded p-3 @enderror mb-2">
                                            <div class="form-group d-block"
                                                id="carregar_modelo">
                                                <label class="control-label font-weight-bold text-success">Upload do modelo do
                                                    certificado</label>
                                                <div class="preview-zone hidden">
                                                    <div class="box box-solid">
                                                        <div class="box-header with-border">
                                                            <div></div>
                                                            <div class="box-tools pull-right">
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-xs remove-preview">
                                                                    Limpar
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body" id="box-body">
                                                            @if ($errors->any())
                                                                <span class="fw-500 text-danger" style="font-size: 16px">Favor
                                                                    Inclua o arquivo novamente.</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-wrapper">
                                                    <div class="dropzone-desc">
                                                        <i class="glyphicon glyphicon-download-alt"></i>
                                                        <p class="font-weight-bold">Arraste o arquivo aqui ou clique para
                                                            selecionar.</p>
                                                        <p class="text-info fs-sm">O arquivo deve ser no formato PNG</p>
                                                    </div>
                                                    <input type="file" name="modelo" class="dropzone" id="modelo"
                                                        value="{{ old('modelo') }}">

                                                </div>
                                                <div id="alert-pdf-format"></div>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fal fa-times"></span> Fechar</button>
                                    <button type="submit" class="btn btn-primary"><span class="fal fa-check-circle"></span> Salvar</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
