<table class="table table-bordered table-hover" id="dt-eventos-cancelados" style="width: 100%">
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
        @foreach ($eventosCancelados as $evento)
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
                    <a class="btn-negativo" href="{{ url('/eventos/' . $evento->id) }}">
                        <span class="a-ic-bt-peq fal fa-eye"></span>Ver Detalhes
                    </a>
                </div>

                <span class="fw-700 text-muted"><small>Local:</small> {{ $evento->local }}</span>
                <br><span class="fw-700 text-muted"><small>(Criado em:
                        {{ date('d/m/Y', strtotime($evento->created_at)) }}. Atualização:
                        {{ date('d/m/Y', strtotime($evento->updated_at)) }})</small></span>
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
                    <a class="btn btn-primary" href="{{ url('evento/' . $evento->id . '/inscritos') }}">
                        <span class="fal fa-users mr-1"></span>Inscrições
                        @if ($evento->inscritos->count() > 0)
                            <span class="badge bg-danger ml-1">{{ $evento->inscritos->count() }}</span>
                        @endif
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
