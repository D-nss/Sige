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
        @foreach($eventosEncerrados as $evento)
            
            <tr>
                <td>
                    <div class="flex-1">
                        <span class="f-sm text-muted">Data Início</span>
                        <br>
                        <span class="fs-lg text-secondary">{{ date('D. M, j Y - H:i', strtotime($evento->data_inicio)) }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="fs-sm text-muted">Data Fim</span>
                        <br>
                        <span class="fs-lg text-secondary">{{ date('D. M, j Y - H:i', strtotime($evento->data_fim)) }}</span>
                    </div>
                </td>
                <td>
                <small class="font-italic fs-lg text-success fw-300">{{ $evento->local }}</span>
                </td>
                <td><span class="fs-lg fw-700 text-primary">{{ $evento->titulo }}</span></td>
                <td><h6 class="text-secondary">{{ $evento->user->name}}</h6></td>
                <td>
                <div class="d-flex flex-column">
                        <a href="" class="btn btn-primary btn-xs mb-1">
                            Ver Detalhes
                        </a>
                        <a href="{{ url('evento/'. $evento->id .'/inscritos')}}" class="btn btn-success btn-xs mb-1">
                            Inscrições
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>