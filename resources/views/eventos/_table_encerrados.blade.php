<table class="table table-bordered table-hover" id="dt-eventos-encerrados" style="width: 100%">
    <thead>
        <tr>
            <th>Período</th>
            <th>Local</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eventosEncerrados as $evento)
            <tr>
                <td>
                    <div class="flex-1">
                        <span class="f-sm text-muted">Data Início</span>
                        <br>
                        <span
                            class="fs-lg text-secondary">{{ date('D. M, j Y - H:i', strtotime($evento->data_inicio)) }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="fs-sm text-muted">Data Fim</span>
                        <br>
                        <span
                            class="fs-lg text-secondary">{{ date('D. M, j Y - H:i', strtotime($evento->data_fim)) }}</span>
                    </div>
                </td>
                <td>
                    <span class="text-secondary">{{ $evento->local }}</span>
                </td>
                <td><span class="fs-lg fw-700 text-primary">{{ $evento->titulo }}</span></td>
                <td>
                    <span class="text-secondary">{{ $evento->user->name }}</span>
                </td>
                <td>
                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <a class="btn btn-primary" href="{{ url('/eventos/' . $evento->id) }}">
                            <span class="fal fa-eye mr-1"></span>Ver Detalhes
                        </a>
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
